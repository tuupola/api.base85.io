<?php

namespace Deployer;

date_default_timezone_set("UTC");

require "recipe/common.php";

set("repository", "git@github.com:tuupola/api.base85.net.git");
set("shared_files", [".env"]);
set("shared_dirs", ["logs"]);
set("writable_dirs", []);
set("default_stage", "production");
set("ssh_type", "native");
set("ssh_multiplexing", true);

$user_data = posix_getpwuid(posix_geteuid());

server("api", "api.base85.net")
    ->stage("production")
    //->user("deployer")
    ->password(null)
    ->set("branch", "master")
    ->set("deploy_path", "/srv/www/api.base85.net");

desc("Run tests");
task("test", function () {
    runLocally("composer test");
});

desc("Deploy your project");
task("deploy", [
    "deploy:prepare",
    "deploy:lock",
    "deploy:release",
    "deploy:update_code",
    "deploy:shared",
    "deploy:vendors",
    "deploy:writable",
    "deploy:clear_paths",
    "deploy:symlink",
    "deploy:unlock",
    "cleanup",
    "success",
]);

before("deploy", "test");
after("deploy", "success");
