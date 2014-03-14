<a class="thumbnail [[+cls]]" href="[[+src]]" title="[[+name]][[+author:is=``:then=``:else=`, ©&nbsp;[[+author]]`]]"><img width="[[+width]]" height="[[+height]]" src='[[+thumbnail_src]]' alt="[[+file]]" /></a>
<p>
  <strong><a href="[[+page_url]]">[[+name]]</a></strong>[[+comment:is=``:then=``:else=`<br />[[+comment]]`]]
</p>
<div>
  <dl>
    <dt>[[%piwigomodx.Author? &namespace=`piwigomodx` &topic=`default`]]</dt>
    <dd>[[+author]]</dd>
    <dt>[[%piwigomodx.Created-on? &namespace=`piwigomodx` &topic=`default`]]</dt>
    <dd>[[+date_creation:strtotime:date=`%A %e %B %Y`]]</dd>
    <dt>[[%piwigomodx.Posted-on? &namespace=`piwigomodx` &topic=`default`]]</dt>
    <dd>[[+date_available:strtotime:date=`%A %e %B %Y`]]</dd>
    [[+tags]]
    [[+categories]]
    <dt>[[%piwigomodx.hit? &namespace=`piwigomodx` &topic=`default`]]</dt>
    <dd>[[+hit]]</dd>
    <dt>[[%piwigomodx.rating-score? &namespace=`piwigomodx` &topic=`default`]]</dt>
    <dd>
      <span>[[+rate_score? &default=`-`]]</span>
      <span>[[+rate_count:is=``:then=``:else=`([[+rate_count]] [[%piwigomodx.rates? &namespace=`piwigomodx` &topic=`default`]])`]]</span>
    </dd>
  </dl>
</div><!-- imageInfos -->
[[+comments:is=``:then:``:else=`<hr />[[+comments]]`]]
