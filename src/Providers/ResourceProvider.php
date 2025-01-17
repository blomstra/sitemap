<?php

/*
 * This file is part of fof/sitemap.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 */

namespace FoF\Sitemap\Providers;

use Flarum\Extension\ExtensionManager;
use Flarum\Foundation\AbstractServiceProvider;
use FoF\Sitemap\Resources;

class ResourceProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->singleton('fof.sitemap.resources', function () {
            $resources = [
                new Resources\User,
                new Resources\Discussion,
            ];

            /** @var ExtensionManager $extensions */
            $extensions = $this->container->make(ExtensionManager::class);

            if ($extensions->isEnabled('flarum-tags')) {
                $resources[] = new Resources\Tag;
            }
            if ($extensions->isEnabled('fof-pages')) {
                $resources[] = new Resources\Page;
            }

            return $resources;
        });
    }
}
