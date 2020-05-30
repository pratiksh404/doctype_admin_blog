<?php

namespace doctype_admin\Blog\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DoctypeAdminBlogInstallerCommand extends Command
{
    protected $signature = "DoctypeAdminBlog:install {--c|config : Installs only config file} {--f|view : Installs only view files} {--m|migration : Installs only migration files} {--s|seed : Installs only seed files} {--t|taggable : Publish Tag Service Provider} {--a|all : Installs all publishable files}";

    protected $description = "This Command installs Doctype Admin Blog Package to your Admin Panel";

    public function handle()
    {
        if (!empty($this->options())) {
            if ($this->option('config')) {
                $this->call('vendor:publish', [
                    '--tag' => ['blog-config']
                ]);
            }
            if ($this->option('view')) {
                $this->call('vendor:publish', [
                    '--tag' => ['blog-views']
                ]);
            }
            if ($this->option('migration')) {
                $this->call('vendor:publish', [
                    '--tag' => ['blog-migrations']
                ]);
            }
            if ($this->option('seed')) {
                $this->call('vendor:publish', [
                    '--tag' => ['blog-seeds']
                ]);
            }
            if ($this->option('taggable')) {
                $this->call('vendor:publish', [
                    '--provider' => ['Conner\Tagging\Providers\TaggingServiceProvider']
                ]);
            }
            if ($this->option('all')) {
                $this->call('vendor:publish', [
                    '--tag' => ['blog-config']
                ]);
                $this->call('vendor:publish', [
                    '--tag' => ['blog-views']
                ]);
                $this->call('vendor:publish', [
                    '--tag' => ['blog-migrations']
                ]);
                $this->call('vendor:publish', [
                    '--tag' => ['blog-seeds']
                ]);
                $this->info("Doctype Admin Blog Installed");
            }
        } else {
            $this->error("Please provide option to DoctypeAdminBlog:install command");
            $this->info("Please see the command structure");
            $this->info("php artisan help DoctypeAdminBlog:install");
        }
    }
}
