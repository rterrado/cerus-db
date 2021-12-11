<?php

declare(strict_types=1);
namespace cerus\Controllers;
use \cerus\models\RecordModel;
use \cerus\Utility;

class RecordController {

    public static function store(
        string $spaceType,
        RecordModel $record
        )
    {
        switch ($spaceType) {
            case 'public':
                $path = $record->root().'/public/'.$record->clientPublicKey();
                $fileSrc = $path.'/'.$record->publicId().'.json';
                file_put_contents($fileSrc,json_encode($record->public()));
                break;

            case 'private':
                $path = $record->root().'/public/'.$record->clientPublicKey().'/'.$record->clientPrivateKey();
                $fileSrc = $path.'/'.$record->privateId().'.json';
                file_put_contents($fileSrc,json_encode($record->private()));
                break;

            case 'meta':
                $path = $record->root().'/.sto/'.$record->namespace().'/mt';
                $fileSrc = $path.'/'.$record->id().'.json';
                file_put_contents($fileSrc,json_encode($record->meta()));
                break;

            case 'index':
                $path = $record->root().'/.sto/'.$record->namespace().'/ix';
                $indexValues = json_decode($record->index(),TRUE);
                foreach ($indexValues as $key => $value) {
                    $indexDir = $path.'/'.$key.'.json';
                    $indexData = [];
                    if (file_exists($indexDir)) {
                        $indexData = json_decode(file_get_contents($indexDir),TRUE);
                    }
                    $indexData[$record->id()] = $value;
                    file_put_contents($indexDir,json_encode($indexData));
                }

            case 'list':
                $path = $record->root().'/.sto/'.$record->namespace().'/ls';
                $fileSrc = $path.'/'.$record->id().'.json';
                file_put_contents($fileSrc,json_encode([
                    'publicId'=>$record->publicId(),
                    'privateId'=>$record->privateId()
                ]));


                // $path = $record->root().'/.sto/'.$record->namespace().'/meta';
                // $fileSrc = $path.'/'.$record->id().'.json';
                // file_put_contents($fileSrc,json_encode($record->meta()));
                break;

            default:
                // code...
                break;
        }
    }


}
