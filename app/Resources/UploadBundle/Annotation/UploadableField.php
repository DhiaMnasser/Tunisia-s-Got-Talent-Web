<?php
namespace Gth\UploadBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class UploadableField{

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }
    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @var string
     */
    private  $filename;

    /**
     * @var string
     */
    private  $path;




    public function __construct(array $options)
    {
        if(empty($options['filename'])){
            throw new \InvalidArgumentException("L'annotation UploadableField doit avoir attribut 'filename'");
        }
        if(empty($options['path'])){
            throw new \InvalidArgumentException("L'annotation UploadableField doit avoir attribut 'path'");
        }
        $this->filename = $options['filename'];
        $this->path = $options['path'];
    }

}