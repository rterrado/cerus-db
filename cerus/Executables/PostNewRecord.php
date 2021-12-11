<?php

declare(strict_types=1);
namespace cerus\Executables;

class PostNewRecord {

    public static function create(
        array $_params
        )
    {
        return "
            <?php
            require '".$_params['root']."/autoloader.php';
            use \cerus\Models\RecordModel;
            use \cerus\Controllers\RecordController;

            $"."record = new RecordModel([
                'root' => '".$_params['root']."',
                'namespace' => '".$_params['namespace']."',
                'clientPublicKey'=>'".$_params['clientPublicKey']."',
                'clientPrivateKey'=>'".$_params['clientPrivateKey']."',
                'publicId'=>'".$_params['recordPublicId']."',
                'privateId'=>'".$_params['recordPrivateId']."',
                'id' => '".$_params['id']."',
                'createdAt' => '".$_params['createdAt']."',
                'updatedAt' => '".$_params['updatedAt']."',
                'index' => '".$_params['index']."'
            ]);

            $"."record->public(json_decode('".$_params['public']."',TRUE));
            $"."record->private(json_decode('".$_params['private']."',TRUE));
            $"."record->meta(json_decode('".$_params['meta']."',TRUE));

            # Stores the public data
            RecordController::store('public',$"."record);

            # Stores the private data
            RecordController::store('private',$"."record);

            # Stores the meta data
            RecordController::store('meta',$"."record);

            # Index data
            RecordController::store('index',$"."record);

            # List data
            RecordController::store('list',$"."record);

            //file_put_contents('".$_params['root']."/.que/".$_params['id'].".json',json_encode($"."record));
        ";
    }

}
