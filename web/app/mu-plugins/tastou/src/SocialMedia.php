<?php

namespace Tastou;

use Illuminate\Support\Collection;

class SocialMedia
{
    private Collection $channels;

    public function __construct()
    {
        $this->channels = collect([
            'facebook' => [
                'label' => __('Facebook', 'tastou'),
                'icon' => 'facebook',
            ],
            'instagram' => [
                'label' => __('Instagram', 'tastou'),
                'icon' => 'instagram',
            ],
            'linkedin' => [
                'label' => __('LinkedIn', 'tastou'),
                'icon' => 'linkedin',
            ],
            'x' => [
                'label' => __('X', 'tastou'),
                'icon' => 'x-twitter',
            ],
            'youtube' => [
                'label' => __('YouTube', 'tastou'),
                'icon' => 'youtube',
            ],
            'vimeo' => [
                'label' => __('Vimeo', 'tastou'),
                'icon' => 'vimeo',
            ],
            'tiktok' => [
                'label' => __('TikTok', 'tastou'),
                'icon' => 'tiktok',
            ],
            'pinterest' => [
                'label' => __('Pinterest', 'tastou'),
                'icon' => 'pinterest',
            ],
            'tripadvisor' => [
                'label' => __('Tripadvisor', 'tastou'),
                'icon' => 'tripadvisor',
            ],
        ]);
    }

    public function allChannels(): Collection
    {
        return $this->channels->map(function ($channel, $key) {
            $channel['link'] = get_field('social_media_'.$key, 'option');

            return $channel;
        });
    }

    public function channels(): Collection
    {
        return $this->allChannels()
            ->filter(function ($channel) {
                return $channel['link'];
            });
    }
}
