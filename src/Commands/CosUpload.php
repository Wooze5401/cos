<?php

namespace Wooze\Cos\Commands;

use Illuminate\Console\Command;
use Wooze\Cos\CosService;

class CosUpload extends Command
{
    protected $cosService;

    public function __construct()
    {
        parent::__construct();

        $this->cosService = new CosService();
    }

    protected $description = 'cos上传文件';

    protected $signature = 'cos:upload {--dir=} {--file=}';

    public function handle()
    {
        $dirName = $this->option('dir');
        if (!$dirName) {
            $this->warn('请输入dir');
        } else {
            $this->info('开始上传');

            $fileName = $this->option('file');

            $this->cosService->uploadFile($dirName, $fileName);

            $this->info('上传完成');
        }
    }

}
