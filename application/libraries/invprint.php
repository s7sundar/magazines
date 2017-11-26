<?php

require_once(__DIR__.'/tcpdf/tcpdf.php');
//require_once(__DIR__.'/currency.php');

class Invprint 
{
	private $pdf;
	private $sales;
	private $items;
	private $iTotalItems;
	private $customer;
	private $iSNo = 1;
	private $iln = 0;
	private $iTotalQty = 0;
	private $iTotal = 0;

	public function __construct()
	{
		$size = explode('x', A5SHEETSIZEMM);	
		$this->pdf = new Trofeo('L', PDF_UNIT, $size , true, 'UTF-8', false);	
		$this->pdf->SetCreator('Trofeo Software Solutions');
		$this->pdf->SetAuthor('AMNA FOOD INDUSTRIES');
		$this->pdf->SetTitle('RETAIL INVOICE');
		$this->pdf->SetSubject('');
		$this->pdf->SetKeywords('');		
		$this->_CI = & get_instance();
	}

	public function get_pdf($data)
	{		
		$this->init($data);
		$limit = 10;
		$aChunked = array_chunk($this->items, $limit);
		foreach ($aChunked as $iKey => $aItems) {
			$this->items = $aItems;
			$this->header();	
			$this->print_items($limit);
			$this->footer();
		}
		$this->display();
	}

	public function init($data)
	{
		$this->pdf->SetHeaderMargin(0);
		$this->pdf->SetMargins(15, 1, 10);
		$this->pdf->setPrintFooter(false);
		$this->pdf->AddPage();
		$this->sales = $data['sales'];
		$this->items = $data['items'];
		$this->iTotalItems = count($data['items']);
		$this->customer = $data['customer'];	
	}

	public function display()
	{
		$this->footer();
		$this->pdf->Output($this->sales['sales_no'].'.pdf', 'I');
	}

	public function header()
	{
		$this->pdf->SetTextColor(104, 104, 104, 0);			
		$tbl  ='<br/><div align="center"><font size="-2"><b>TAX/INVOICE</b><br/>';
		$tbl .=' FORM No.8</font></div>'; 
		//$tbl .='<br/><div align="right"><font size="-2"><b>FORM No.8</b></font></div>'; 
		$tbl .='<table cellspacing="0" cellpadding="1" width="100%" style="border-bottom:1px solid #989898">';				
		$tbl .='<tr><td align="center" width="100%">';		
		//$tbl .= '<b><font size="-2">FORM No.8</font></b><br/>';
		$tbl .= '<b><font size="+1">AMNA FOOD INDUSTRIES</font></b><br/>';
		$tbl .= '<font size="-3">15/696, Near Sathrapadi Water Tank, Kanjikode Post,Palakkad - 678 621.<br />
           			Phone : 91 808600 88 99  E-Mail : info@amnafoods.com<br />
            		TIN: 32090523265  CST: 32090523265C</font>
				 </td></tr>';	
		$tbl .= '<tr>';
		$tbl .= '<td style="border-top:1px solid #989898"><table width="100%"><tr>';
		$tbl .= '<td style="border-right:1px solid #989898; font-size:9px">';
		$tbl .= $this->get_customer_details();
		$tbl .= '</td>';
		$tbl .= '<td style="font-size:9px">';
		$tbl .= $this->get_salesno_details();
		$tbl .= '</td>';		
		$tbl .= '</tr></table></td>';
		$tbl .= '</tr>';		 		
		$tbl .= ' </table>';
		$this->pdf->writeHTML($tbl, true, false, false, false, '');		
	}

	public function get_customer_details()
	{
		$pHtml = '';
		$pHtml .= '<p>To<br/>';
		$pHtml .= '<strong style="padding-left:20px">'.$this->customer['name'].'</strong>,<br/>';
		$pHtml .= $this->customer['address1'].$this->customer['address2'].'-'.$this->customer['pincode'].'.<br/>';
		$pHtml .= 'Mobile: '.$this->customer['mobile'].'.<br/>';
		$pHtml .= 'TIN No:'.$this->customer['tinno'];
		$pHtml .= '</p>';		
		return  $pHtml;
	}

	public function get_salesno_details()
	{
		$pHtml = '';
		$pHtml .= '<table cellspacing="0" cellpadding="1" width="100%">';
		$pHtml .= '<tr>';
		$pHtml .= '<td width="25%">Bill No</td>';
		$pHtml .= '<td width="5%">:</td>';
		$pHtml .= '<td width="70%"><strong>'.strtoupper(substr($this->sales['vechicle_code'],0,2)).'/'.$this->sales['sales_no'].'</strong></td>';
		$pHtml .= '</tr>';
		$pHtml .= '<tr>';
		$pHtml .= '<td width="25%">Date</td>';
		$pHtml .= '<td width="5%">:</td>';
		$pHtml .= '<td width="70%"><strong>'.date('d/m/Y',strtotime($this->sales['sales_date'])).'</strong></td>';
		$pHtml .= '</tr>';
		$pHtml .= '<tr>';
		$pHtml .= '<td width="25%">Mode Of Pay</td>';
		$pHtml .= '<td width="5%">:</td>';
		$pHtml .= '<td width="70%"><strong>'.$this->sales['mode_of_pay'].'</strong></td>';
		$pHtml .= '</tr>';

		$pHtml .= '</table>';
		return $pHtml;
	}

	public function print_items($limit)
	{
		$this->pdf->SetY($this->pdf->GetY()-6);		
		$tbl ='<table cellspacing="0" cellpadding="1" width="100%">';	

		//item header
		$tbl .= '<tr style="font-size:9px;">';
		$tbl .= '<th style="vertical-align:middle;border-bottom:1px solid #989898;" width="5%"><strong>S.No</strong></th>';
		$tbl .= '<th style="border-bottom:1px solid #989898;" align="left" width="36%"><strong>Particulars</strong></th>';
		$tbl .= '<th style="border-bottom:1px solid #989898;" align="right" width="8%"><strong>Tax %</strong></th>';		
		$tbl .= '<th style="border-bottom:1px solid #989898;" align="right" width="8%"><strong>Qty</strong></th>';
		$tbl .= '<th style="vertical-align:middle;border-bottom:1px solid #989898;" align="right" width="10%"><strong>Rate</strong></th>';
		$tbl .= '<th style="vertical-align:middle;border-bottom:1px solid #989898;" align="right" width="11%"><strong>Amount</strong></th>';
	    $tbl .= '<th style="vertical-align:middle;border-bottom:1px solid #989898;" align="right" width="10%"><strong>Tax Amt</strong></th>';		
	    $tbl .= '<th style="vertical-align:middle;border-bottom:1px solid #989898;" align="right" width="12%"><strong>Net Amt</strong></th>';
		$tbl .= '</tr>';

		foreach ($this->items as $row) {
			//$uom =  ($row['uom']==1)?'Mts':'Nos';
			$tbl .= '<tr style="font-size:10px">';
			$tbl .= '<td align="right">'.$this->iSNo++.'.</td>';			
			$tbl .= '<td>'.$row['item_name'].'</td>';
			$tbl .= '<td align="right">'.$row['tax_per'].'% &nbsp;</td>';
			$tbl .= '<td align="right">'.$row['qty'].'</td>';
			$tbl .= '<td align="right">'.$row['rate'].'</td>';
			$tbl .= '<td align="right">'.$row['total'].'</td>';	

			$taxamt = sprintf('%02.2f',$row['total']*$row['tax_per']/100);
			$netamt = sprintf('%02.2f',$row['total']+$taxamt);

			$tbl .= '<td align="right">'.$taxamt.'</td>';	
			$tbl .= '<td align="right">'.$netamt.'</td>';	
			$tbl .= '</tr>';
			$this->iTotalQty += $row['qty'];
			$this->iTotal += $row['total'];
		}

	  if(($this->iSNo-1)==$this->iTotalItems)
	   {
			if(($this->iSNo-1)>1)
	        {
				$tbl .= '<tr style="font-size:10px;">';
				$tbl .= '<td></td>';			
				$tbl .= '<td align="right">SUB TOTAL</td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td align="right" style="border-top:1px dotted #989898">'.sprintf("%0.2f",$this->iTotal).'</td>';	
				$tbl .= '<td></td>';	
				$tbl .= '<td></td>';	
				$tbl .= '</tr>';
	        }

			if(($this->sales['kvat_amt'])>1)
	        {
				$tbl .= '<tr style="font-size:10px;">';
				$tbl .= '<td></td>';			
				$tbl .= '<td align="right">KVAT</td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td align="right">'.sprintf("%0.2f",$this->sales['kvat_amt']).'</td>';	
				$tbl .= '<td></td>';	
				$tbl .= '<td></td>';	
				$tbl .= '</tr>';
	        }

			if(($this->sales['disc_amt'])>1)
	        {
				$tbl .= '<tr style="font-size:10px;">';
				$tbl .= '<td></td>';			
				$tbl .= '<td align="right">Discount</td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td align="right">'.sprintf("%0.2f",$this->sales['disc_amt']).'</td>';	
				$tbl .= '<td></td>';	
				$tbl .= '<td></td>';	
				$tbl .= '</tr>';
	        }
	        
			if(($this->sales['round_off'])!=0)
	        {
				$tbl .= '<tr style="font-size:10px;">';
				$tbl .= '<td></td>';			
				$tbl .= '<td align="right">Round.Off</td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td></td>';
				$tbl .= '<td align="right">'.sprintf("%0.2f",$this->sales['round_off']).'</td>';	
				$tbl .= '<td></td>';	
				$tbl .= '<td></td>';	
				$tbl .= '</tr>';
	        }
	    }   
			$tbl .= '</table>';
			$this->pdf->writeHTML($tbl, true, false, false, false, '');	    
    }

	public function footer()
	{

		$this->pdf->SetY(116);			
		$tbl = '';
	    $tbl .='<table cellspacing="0" cellpadding="1" width="100%" style="border-top:1px solid #989898;">';

		if(($this->iSNo-1)==$this->iTotalItems)
		 {
		  
			$tbl .= '<tr style="font-size:10px;">';
			$tbl .= '<td colspan="2" align="right"><strong>TOTAL</strong> </td>';
			$tbl .= '<td align="right"><strong>'.sprintf("%0.3f",$this->iTotalQty).'</strong> </td>';
			$tbl .= '<td colspan="1" align="right"><strong>'.sprintf("%0.2f",$this->sales['net_amt']).'</strong>&nbsp; &nbsp;</td>';	
			$tbl .= '<td colspan="1">&nbsp;</td>';
			$tbl .= '</tr>';
		
        }
		  $tbl .= '<tr style="font-size:10px;">';
	    		$tbl .= '<td rowspan="2"; colspan=3; style="border-top:1px solid #989898;" width="70%"><font size="-3">DECLARATION: Certified that all the particulars show in the above Tax Invoice are true and correct and that my/our Registration under KVAT Act 2003 is valid as on the date of this bill</font></td>';
			//$tbl .= '<td align="left" style="border-top:1px solid #989898;" width="50%">Recevier\'s Signature </td>';
			//$tbl .= '<td>&nbsp;</td>';
			$tbl .= '<td align="right" style="border-top:1px solid #989898;" width="30%">For AMNA FOOD INDUSTRIES </td>';
			$tbl .= '</tr>';

			$tbl .= '</table>';

			$this->pdf->writeHTML($tbl, true, false, false, false, '');		    
   }	
}

class Trofeo extends TCPDF
{
	public function Header()
	{
		$this->writeHTMLCell($w='', $h='', $x='', $y='', '', $border=0, $ln=0, $fill=0, $reseth=true, $align='L', $autopadding=true);
		$this->SetLineStyle( array( 'width' => 0.5, 'color' => array(152,152,152)));	
		$this->Line(15, 10, $this->getPageWidth()-10, 10);	
		$this->Line($this->getPageWidth()-10, 10, $this->getPageWidth()-9,  $this->getPageHeight()-10);
		$this->Line(15, $this->getPageHeight()-10, $this->getPageWidth()-10, $this->getPageHeight()-10);
		$this->Line(15, 10, 15, -(10-$this->getPageHeight()));
	}
}