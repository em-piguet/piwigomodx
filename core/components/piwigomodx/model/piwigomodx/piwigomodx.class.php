<?php
/**
 * PiwigoModx
 *
 * Copyright 2014 by Philippe Juillerat <philippe.juillerat@filago.ch>
 *
 * This file is part of PiwigoModx.
 *
 * PiwigoModx is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * PiwigoModx is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Babel; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package piwigomodx
 */
/**
 * This file is the main class file for PiwigoModx. Used for querying
 * the Piwigo gallery, handling templating and running snippets.
 *
 * Based on Piwigo2Modx, see https://gitorious.org/piwigo2modx
 *
 * @author Epy (webmaster@aide-en-info.net)
 * @author Philippe Juillerat <philippe.juillerat@filago.ch>
 *
 * @package piwigomodx
 */
class PiwigoModx {
    /**
     * @var modX A reference to the modX object.
     */
    public $modx = null;
    /**
     * @var array An array of configuration options
     */
    public $config = array();

    function __construct(modX &$modx, array $config = array()) {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('piwigomodx.core_path',$config,$this->modx->getOption('core_path').'components/piwigomodx/');

        $piwigoUrl = $this->modx->getOption('piwigomodx.piwigo_url',$config,MODX_SITE_URL.'piwigo/');
        $piwigoWS = $this->modx->getOption('piwigomodx.piwigo_WS',$config,'ws.php');
        $piwigoWSFormat = 'php';

        $this->config = array_merge(array(
            'corePath' => $corePath,
            'modelPath' => $corePath.'model/',
            'chunksPath' => $corePath.'elements/chunks/',
            'chunkSuffix' => '.chunk.tpl',
            'piwigoUrl' => $piwigoUrl,
            'piwigoWS' => $piwigoWS,
            'piwigoWSFormat' => $piwigoWSFormat
        ),$config);

        /* load piwigomodx lexicon */
        if ($this->modx->lexicon) {
            $this->modx->lexicon->load('piwigomodx:default');
        }
    }

    /**
     * Split a parameter by a pipe | character.
     *
     * @access public
     * @param mixed $param The parameter to split
     * @return mixed An array of strings or the input parameter if no
     * pipe character was found
     */
    public function explodeParams($param) {
        $params = explode('|',$param);
        if (count($params) > 1) {
            $param = $params;
        }
        return $param;
    }

    /**
     * Query Piwigo API see (http://piwigo.org/demo/tools/ws.htm).
     *
     * @access public
     * @param string $method The name a method available for Piwigo API
     * @param array $options optional Parameters used for the method
     * @return array The response returned by Piwigo API
     */
    public function parseQuery($method,$options = array()) {
        /* build request path */
        $options['method'] = $method;
        $options['format'] = $this->config['piwigoWSFormat'];
        $query = http_build_query($options);
        $piwigoUrl = $this->config['piwigoUrl'];
        if (substr($piwigoUrl, -1) != '/') {
            $piwigoUrl .= '/';
        }
        $url = $piwigoUrl.$this->config['piwigoWS'].'?'.$query;

        /* prevent invalid xhtml ampersands in request path */
        $url = str_replace('&amp;', '&', $url);

        /* configuring CURL */
        $user_agent ='Piwigo';
        $session = curl_init();
        curl_setopt($session, CURLOPT_URL,$url);
        curl_setopt($session, CURLOPT_HEADER, 0);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_USERAGENT, $user_agent);

        /* get serialized array from request */
        $response = curl_exec($session);
        curl_close($session);
        $result = unserialize($response);

        if ($result["stat"] != 'ok') {
            $this->modx->log(xPDO::LOG_LEVEL_ERROR, 'Can\'t parse URL: '.$url);
            $result = false;
        }
        return $result;
    }

    /**
     * Gets a Chunk and caches it; also falls back to file-based templates
     * for easier debugging.
     *
     * @access public
     * @param string $name The name of the Chunk
     * @param array $properties The properties for the Chunk
     * @return string The processed content of the Chunk
     */
    public function getChunk($name,array $properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->modx->getObject('modChunk',array('name' => $name),true);
            if (empty($chunk)) {
                $chunk = $this->_getTplChunk($name,$this->config['chunkSuffix']);
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }

    /**
     * Returns a modChunk object from a template file.
     *
     * @access private
     * @param string $name The name of the Chunk. Will parse to name.chunk.tpl by default.
     * @param string $suffix The suffix to add to the chunk filename.
     * @return modChunk/boolean Returns the modChunk object if found, otherwise
     * false.
     */
    private function _getTplChunk($name,$suffix = '.chunk.tpl') {
        $chunk = false;
        $f = $this->config['chunksPath'].strtolower($name).$suffix;
        if (file_exists($f)) {
            $o = file_get_contents($f);
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name',$name);
            $chunk->setContent($o);
        }
        return $chunk;
    }
}
