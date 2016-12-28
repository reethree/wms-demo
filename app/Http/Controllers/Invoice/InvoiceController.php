<?php

namespace App\Http\Controllers\Invoice;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    
    public function invoiceIndex()
    {
        if ( !$this->access->can('show.invoice.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Invoice";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Invoice'
            ]
        ];        
        
        return view('invoice.index-invoice')->with($data);
    }
    
    public function tarifIndex()
    {
        if ( !$this->access->can('show.tarif.index') ) {
            return view('errors.no-access');
        }
        
        $data['page_title'] = "Daftar Tarif";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Daftar Tarif'
            ]
        ];        
        
        return view('invoice.index-tarif')->with($data);
    }
    
    public function tarifView($id)
    {
        if ( !$this->access->can('show.tarif.view') ) {
            return view('errors.no-access');
        }
        
        $tarif = \DB::table('invoice_tarif')->find($id);
        
        $data['page_title'] = "Daftar Item Tarif ".$tarif->type;
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('invoice-tarif-index'),
                'title' => 'Daftar Tarif'
            ],
            [
                'action' => '',
                'title' => "Daftar Item Tarif ".$tarif->type
            ]
        ];        
        
        $data['tarif'] = $tarif;
        
        return view('invoice.view-tarif')->with($data);
    }
    
    public function tarifItemEdit($id)
    {
        if ( !$this->access->can('show.tarif.item.edit') ) {
            return view('errors.no-access');
        }
        
        $tarif_item = \DB::table('invoice_tarif_item')->find($id);
        
        $data['page_title'] = "Edit Item Tarif ".$tarif_item->description;
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('invoice-tarif-index'),
                'title' => 'Daftar Tarif'
            ],
            [
                'action' => '',
                'title' => "Edit Item Tarif ".$tarif_item->description
            ]
        ];        
        
        $data['item'] = $tarif_item;
        
        return view('invoice.edit-tarif')->with($data);
    }

}
