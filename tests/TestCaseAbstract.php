<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/mercadopago-sdk
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\MercadopagoSdk\Tests;

use Gpupo\MercadopagoSdk\Factory;
use Gpupo\Tests\CommonSdk\TestCaseAbstract as CommonSdkTestCaseAbstract;

abstract class TestCaseAbstract extends CommonSdkTestCaseAbstract
{
    private $factory;

    public static function getResourcesPath()
    {
        return dirname(__DIR__).'/Resources/';
    }

    public function factoryClient()
    {
        return $this->getFactory()->getClient();
    }

    protected function getOptions()
    {
        return [
            'app_id' => $this->getConstant('APP_ID'),
            'secret_key' => $this->getConstant('SECRET_KEY'),
            'access_token' => $this->getConstant('ACCESS_TOKEN'),
            'verbose' => $this->getConstant('VERBOSE'),
            'dryrun' => $this->getConstant('DRYRUN'),
            'registerPath' => $this->getConstant('REGISTER_PATH'),
        ];
    }

    protected function getFactory()
    {
        if (!$this->factory) {
            $this->factory = Factory::getInstance()->setup($this->getOptions(), $this->getLogger());
        }

        return $this->factory;
    }

    /**
     * Requer Implementação mas não será abstrato para não impedir testes que não o usam.
     *
     * @param null|mixed $filename
     */
    protected function getManager($filename = null)
    {
        unset($filename);
    }

    protected function hasToken()
    {
        return $this->hasConstant('SECRET_KEY');
    }
}
