<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($posts as $post)<url>
    <loc>{{$siteURL}}{{ $post->lang->lng }}/posts/{{$post->unique_id}}/{{urlencode($post->title)}}</loc>
    <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
    <postid>{{ $post->title}}</postid>
  </url>
  @endforeach
</urlset>
