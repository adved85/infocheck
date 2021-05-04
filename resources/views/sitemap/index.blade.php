<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @if ($post)<sitemap>
    <loc>{{$siteURL}}sitemap/posts</loc>
    <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
  </sitemap>
  @endif
@if ($question)<sitemap>
    <loc>{{$siteURL}}sitemap/news</loc>
    <lastmod>{{ $question->updated_at->tz('UTC')->toAtomString() }}</lastmod>
  </sitemap>
  @endif
</sitemapindex>
