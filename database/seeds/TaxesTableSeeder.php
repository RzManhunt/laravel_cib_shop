<?php

use Illuminate\Database\Seeder;
use App\Tax;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tax::create([
        	'id' => 'E',
        	'description' => 'EXENTO. No asigna ningun valor al monto del impuesto',
		    'amount' => 0,
        ]);

        Tax::create([
        	'id' => 'O',
        	'description' => 'ORDINARIO. Asigna el valor mas comun de impuesto',
		    'amount' => 18.00,
        ]);

        Tax::create([
        	'id' => 'R',
        	'description' => 'REDUCIDO. Asigna un procentaje menor de impuesto, solo aplica a situaciones extraordinarias',
		    'amount' => 14,
        ]);
    }
}
