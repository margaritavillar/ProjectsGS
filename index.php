<?php
/* The Model */
class CurrencyConverter{
    private $baseValue = 0;
    private $rates = [
        'GBP' => 1.0,
        'USD' => 0.6,
        'EUR' => 0.83,
        'CAD' => 0.5,
        'YEN' => 0.0062
    ];
    public function get($currency){
        if(isset($this->rates[$currency])){
            $rate = 1 / $this->rates[$currency];
            return round($this->baseValue * $rate, 2);
        }
        else return 0;    
    }
    public function set($amount, $currency='GBP'){
        if(isset($this->rates[$currency])){
            $this->baseValue = $amount * $this->rates[$currency];        
        }
    }
}
/* TESTE MODEL 
// Create an object of type CurrecyConverter
$currencyConverter = new CurrencyConverter;
// Set values
$currencyConverter->set(100, 'USD');
echo '100 USD is: ';
echo $currencyConverter->get('GBP') . 'GBP / ';
echo $currencyConverter->get('EUR') . 'EUR / ';
echo $currencyConverter->get('CAD') . 'CAD / ';
echo $currencyConverter->get('YEN') . 'YEN / ';

*/

/* The View */

class CurrencyConverterView{
    private $currency;
    private $converter;

    public function __construct(CurrencyConverter $converter, $currency){
        $this->currency = $currency;
        $this->converter = $converter;
    }

    public function output(){
        $html = '<form action="?action=convert" method="post">'
            . '<input name="currency" type="hidden" value="'.$this->currency.'">'
            . '<label>' .$this->currency. ': </label>'
            . '<input name = "amount" type="text" value =" This is a test'.$this->converter->get($this->currency).'">'//Juan added a comment
            . '<input type="submit" value="Convert">'
            . '</form>';
        return $html;
    }
}

 /* TEST VIEW */

 /*
 $currencyConverter = new CurrencyConverter;
 $view = new CurrencyConverterView($currencyConverter, 'GBP');
 echo $view->output();
 */

 /*
 $currencyConverter = new CurrencyConverter;
 $currencyConverter->set('100', 'GBP');
 // Different currencies

 $gbpview = new CurrencyConverterView($currencyConverter, 'GBP');
 echo $gbpview->output();
 $usdview = new CurrencyConverterView($currencyConverter, 'USD');
 echo $usdview->output();
 $eurview = new CurrencyConverterView($currencyConverter, 'EUR');
 echo $eurview->output();
 $cadview = new CurrencyConverterView($currencyConverter, 'CAD');
 echo $cadview->output();
 $yenview = new CurrencyConverterView($currencyConverter, 'YEN');
 echo $yenview->output();
 */

/* The Controller */

class CurrencyConverterController{

    private $currencyConverter;

    public function __construct(CurrencyConverter $currencyConverter){
        $this->currencyConverter =  $currencyConverter;
    }

    public function convert($request){
        if(isset($request['currency']) && isset($request['amount'])){
            $this->currencyConverter->set($request['amount'], $request['currency']);
        }
    }
}

$model = new CurrencyConverter();
$controller = new CurrencyConverterController($model);
if(isset($_GET['action'])) $controller->{$_GET['action']}($_POST);
//$controller->convert($_POST);

 $gbpview = new CurrencyConverterView($model, 'GBP');
 echo $gbpview->output();
 $usdview = new CurrencyConverterView($model, 'USD');
 echo $usdview->output();
 $eurview = new CurrencyConverterView($model, 'EUR');
 echo $eurview->output();
 $cadview = new CurrencyConverterView($model, 'CAD');
 echo $cadview->output();
 $yenview = new CurrencyConverterView($model, 'YEN');
 echo $yenview->output();







?>