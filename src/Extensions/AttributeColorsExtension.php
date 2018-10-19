<?php
namespace AttributeColors\Extensions;

use Plenty\Modules\System\Contracts\WebstoreRepositoryContract;
use Plenty\Plugin\Http\Request;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Templates\Extensions\Twig_Extension;
use Plenty\Plugin\Templates\Factories\TwigFactory;



class AttributeColorsExtension extends Twig_Extension
{
  /**
     * @var TwigFactory
     */
    private $factory;
    private $configRepository;
    private $url = "https://www.dsguided.com/";

    /**
     * ThemeTwigExtension constructor.
     * @param TwigFactory $factory
     */
    public function __construct(TwigFactory $factory, ConfigRepository $configRepository)
    {
        $this->factory = $factory;
        $this->configRepository = $configRepository;
    }
    /**
     * @return string
     * Name of the Extension
     */
    public function getName(): string
    {
        return "AttributeColorsExtension";
    }

    /**
    * @return Array
    * Register Functions
    */
    public function getFunctions(): array
    {
      return [
        $this->factory->createSimpleFunction('getFree', [$this, 'getFree']),
        $this->factory->createSimpleFunction('getVars', [$this, 'getVars']),
      ];
    }
    /**
    * getFunctions wird benötigt um eigene Funktionen in TWIG zu nutzen
    * createSimpleFunction('Name im Twig', [$this(Klasse wo sich die Funktion befindet) , 'Funktionsname innerhalb der Klasse'])
    */
    private function curl_auth() : string
    {
      $user = $this->configRepository->get('AttributeColors.rest.user');
      $password = $this->configRepository->get('AttributeColors.rest.pass');
      $curl = curl_init( $this->url.'rest/login' );
      curl_setopt( $curl, CURLOPT_POST, true ); // Schaltet zu POST um
      curl_setopt( $curl, CURLOPT_POSTFIELDS, array(
       'username' => $user,
       'password' => $password,
     ) );
     curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt( $curl, CURLOPT_TIMEOUT, 4);
     $token = curl_exec($curl);
     $token = json_decode($token);
     $token = $token->accessToken;
     return $token;
    }

    private function curl_set(string $url)
    {
      $token = $this->curl_auth();
      $curl = curl_init($url);
      curl_setopt($curl,CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$token));
      curl_setopt($curl, CURLOPT_HTTPGET,0);
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt( $curl, CURLOPT_TIMEOUT, 4);
      $result = curl_exec($curl);
      $result = json_decode($result, true);
      curl_close($curl);
      return $result;
    }


    // Get FreeFields
    public function getFree(int $itemID) : array
    {
      $itemInfo = $this->curl_set($this->url."rest/items/".$itemID);
      return $itemInfo;
    }
    // Get Variations
    public function getVars(int $itemID) : array
    {
      $itemInfo = $this->curl_set($this->url."rest/items/".$itemID."/variations");
      return $itemInfo;
    }
}
