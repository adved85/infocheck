<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($questions as $quest)<url>
    <loc>{{$siteURL}}{{ $quest->lang->lng }}/faqs</loc>
    <lastmod>{{ $quest->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
    <postid>{{ $quest->id}}</postid>
  </url>
  @endforeach
</urlset>
