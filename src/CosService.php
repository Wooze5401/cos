<?php
namespace Wooze\Cos;

use Qcloud\Cos\Client;

class CosService
{
    protected $cosClient;
    private $root;

    public function __construct()
    {
        $this->root = config("cos.root");

        $this->cosClient = new Client([
            'region' => config('cos.region'),
            'credentials' => [
                'secretId' => config('cos.secret_id'),
                'secretKey' => config('cos.secret_key')
            ]
        ]);
    }

    public function getClient()
    {
        return $this->cosClient;
    }


    public function uploadFile($dirName, $fileName = null)
    {

        //public下的文件夹
        $tag = $dirName."/";
        $dir = $this->root.$tag;
        if (!is_dir($dir)) {
            exit("目录不存在\n");
        }

        if ($fileName) {
            $file = $dir.$fileName;
            if (!file_exists($file)) {
                exit("文件不存在\n");
            }

            $key = $tag.$fileName;
            $this->upload($key, $file);
        } else {
            $file = scandir($dir);
            unset($file[0]);
            unset($file[1]);
            if ($file[2] == ".DS_Store") {
                unset($file[2]);
            }

            foreach ($file as $item) {
                $key = $tag.$item;
                $file = $dir.$item;
                if (is_dir($file)) {
                    $this->uploadFile($key);
                } else {
                    echo ('正在上传：'.$file."\n");
                    $this->upload($key, $file);
                }
            }
        }

        return;
    }




    protected function upload($key, $item)
    {
        $result = $this->cosClient->putObject(array(
            'Bucket' => config('cos.bucket'),
            'Key' => $key,
            'Body' => fopen($item, 'r')
        ));

        print_r(urldecode($result->get('ObjectURL'))."\n");
    }
}
