<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    
    @if(@$districts)
        @foreach ($districts as $district)
        <url>
            <loc>{{url(@$district->bank->slug.'/'.$district->state_slug.'/'.$district->district_slug)}}
            </loc>
            <lastmod>{{ ($district->updated_at) ? $district->updated_at->tz('UTC')->toAtomString():
             \Carbon\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.9</priority>
        </url>
        @endforeach
     @endif

</urlset>