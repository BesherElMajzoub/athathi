<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistrictPage extends Model
{
    protected $fillable = [
        'cluster_key',
        'cluster_name_ar',
        'neighborhood_name_ar',
        'neighborhood_slug',
        'meta_title',
        'meta_description',
        'content_ar',
        'faqs',
        'landmarks',
        'status',
        'word_count',
    ];

    protected $casts = [
        'faqs'      => 'array',
        'landmarks' => 'array',
    ];

    /**
     * Only published pages.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Filter by cluster.
     */
    public function scopeInCluster($query, string $clusterKey)
    {
        return $query->where('cluster_key', $clusterKey);
    }

    /**
     * Get nearby neighborhoods (same cluster, excluding self).
     */
    public function nearbyNeighborhoods(int $limit = 4)
    {
        return self::published()
            ->where('cluster_key', $this->cluster_key)
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    /**
     * Validate minimum word count.
     */
    public function meetsMinWordCount(int $min = 900): bool
    {
        return $this->word_count >= $min;
    }

    /**
     * Calculate and set word count from content.
     */
    public function calculateWordCount(): void
    {
        $text = strip_tags($this->content_ar);
        $this->word_count = count(preg_split('/\s+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY));
    }
}
