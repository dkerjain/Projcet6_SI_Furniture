<!DOCTYPE html>
<html>
<head>
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }
            </style>

            <!-- CSS Reset : END -->

            <!-- Progressive Enhancements : BEGIN -->
            <style>

        	    .primary{
        	background: #17bebb;
        }
        .bg_white{
        	background: #ffffff;
        }
        .bg_light{
        	background: #f7fafa;
        }
        .bg_black{
        	background: #000000;
        }
        .bg_dark{
        	background: rgba(0,0,0,.8);
        }
        .email-section{
        	padding:2.5em;
        }

        /*BUTTON*/
        .btn{
        	padding: 10px 15px;
        	display: inline-block;
        }
        .btn.btn-primary{
        	border-radius: 5px;
        	background: #17bebb;
        	color: #ffffff;
        }
        .btn.btn-white{
        	border-radius: 5px;
        	background: #ffffff;
        	color: #000000;
        }
        .btn.btn-white-outline{
        	border-radius: 5px;
        	background: transparent;
        	border: 1px solid #fff;
        	color: #fff;
        }
        .btn.btn-black-outline{
        	border-radius: 0px;
        	background: transparent;
        	border: 2px solid #000;
        	color: #000;
        	font-weight: 700;
        }
        .btn-custom{
        	color: rgba(0,0,0,.3);
        	text-decoration: underline;
        }

        h1,h2,h3,h4,h5,h6{
        	font-family: sans-serif;
        	color: #000000;
        	margin-top: 0;
        	font-weight: 400;
        }

        body{
        	font-family: sans-serif;
        	font-weight: 400;
        	font-size: 15px;
        	line-height: 1.8;
        	color: rgba(0,0,0,.4);
        }

        a{
        	color: #17bebb;
        }

        table{
        }
        /*LOGO*/

        .logo h1{
        	margin: 0;
        }
        .logo h1 a{
        	color: #17bebb;
        	font-size: 24px;
        	font-weight: 700;
        	font-family:s sans-serif;
        }

        /*HERO*/
        .hero{
        	position: relative;
        	z-index: 0;
        }

        .hero .text{
        	color: rgba(0,0,0,.3);
        }
        .hero .text h2{
        	color: #000;
        	font-size: 34px;
        	margin-bottom: 15px;
        	font-weight: 300;
        	line-height: 1.2;
        }
        .hero .text h3{
        	font-size: 24px;
        	font-weight: 200;
        }
        .hero .text h2 span{
        	font-weight: 600;
        	color: #000;
        }


        /*PRODUCT*/
        .product-entry{
        	display: block;
        	position: relative;
        	float: left;
        	padding-top: 20px;
        }
        .product-entry .text{
        	width: calc(100% - 125px);
        	padding-left: 20px;
        }
        .product-entry .text h3{
        	margin-bottom: 0;
        	padding-bottom: 0;
        }
        .product-entry .text p{
        	margin-top: 0;
        }
        .product-entry img, .product-entry .text{
        	float: left;
        }

        ul.social{
        	padding: 0;
        }
        ul.social li{
        	display: inline-block;
        	margin-right: 10px;
        }

        /*FOOTER*/

        .footer{
        	border-top: 1px solid rgba(0,0,0,.05);
        	color: rgba(0,0,0,.5);
        }
        .footer .heading{
        	color: #000;
        	font-size: 20px;
        }
        .footer ul{
        	margin: 0;
        	padding: 0;
        }
        .footer ul li{
        	list-style: none;
        	margin-bottom: 10px;
        }
        .footer ul li a{
        	color: rgba(0,0,0,1);
        }
    </style>
</head>
<body width="100%" style="margin: 0; padding: 0 !important;background-color: #ffffff;">
	<center style="width: 100%; background-color: #ffffff;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
    </div>
    <div style="max-width: 100%; margin: 0 auto;" class="email-container">
    	<!-- BEGIN BODY -->
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="top" class="bg_white" style="padding: 2.5em 1em 0 1em;">
          	<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
          		<tr>
          			<td class="logo" style="text-align: left;">
			            <img src="" style="width:250px" alt="">
                  <p style="margin-top:0; font-weight:normal; color:#000; padding-left:1.5em; font-size:12px;">Alamat Bengkel Kerja :
            <br>Jl. Raya Kedungsari (Simpang Tiga) Kec. Kemlagi - Mojokerto.
            <br>(Jalur Mojokerto Menuju Ploso JOMBANG) JAWA TIMUR 
            <br>Transfer ke :
            <br>BRI 123456789 A.N Budi Nur Cahyo 
            <br>BNI 123456789 A.N Budi Nur Cahyo </p>

			          </td>
          		</tr>
          	</table>
          </td>
	      </tr><!-- end tr -->
				<tr>
          <td valign="middle" class="hero bg_white" style="padding: 1em 0 1em 0;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            	<tr>
            		<td style="padding: 0 2.5em; text-align: left;">
            			<div class="text">
            		<p style="color:black; margin-bottom:0; font-weight:bold">ID Pemesanan</p>
                    <p style="color:black; margin-top:0; margin-bottom:0">{{$order->id}}</p>
                    <p style="color:black; margin-bottom:0; font-weight:bold">Nama & Alamat Pemesan</p>
                    <p style="color:black; margin-top:0; margin-bottom:0">{{$order->customer->nama_customer}}</p>
                    <p style="color:black; margin-top:0;">{{$order->customer->alamat}}</p>

                    <p style="color:black; margin-bottom:0;font-weight:bold">Tanggal Belanja</p>
                    <p style="color:black; margin-top:0;">{{date_format($order->created_at,"d F Y H:i")}}</p>

                    <p style="color:black; margin-bottom:0;font-weight:bold">Status Pembayaran</p>
                    @if ($order->pembayaran->status_pembayaran==0)
                    <p style="color:black; margin-top:0;">Belum Lunas</p>
                    @else
                    <p style="color:black; margin-top:0;">Lunas</p>
                    @endif
            			</div>
            		</td>
            	</tr>
            </table>
          </td>
	      </tr><!-- end tr -->
	      <tr>
          <td valign="middle" class="hero bg_white" style="padding: 1em 0 1em 0;">
            <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
  	      		<tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                <th width="15%" style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 20px">No</th>
                <th width="40%" style="text-align:left; color: #000; padding-bottom: 20px">Item</th>
                <th width="15%" style="text-align:center; color: #000; padding-bottom: 20px">Jumlah</th>
  					    <th width="30%" style="text-align:center; color: #000; padding-bottom: 20px">Subtotal</th>
  					  </tr>
              @for($i=0;$i<count($order->orderList);$i++)
  					  <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                <td width="15%" style="text-align:center; padding: 1em 2.5em 1em;">{{$i+1}}</td>
                <td width="40%" style="text-align:left;">{{$order->orderList[$i]->produk->nama_produk}}</td>
                <td width="15%" style="text-align:center;">{{$order->orderList[$i]->jumlah}}</td>
  					  	<td width="30%" style="text-align:center;">Rp {{number_format($order->orderList[$i]->harga_subtotal,0,',','.')}}</td>
  					  </tr>
              @endfor
  	      	</table>
          </td>
	      </tr>
        <tr>
          <td valign="middle" class="bg_white">
            <table class="bg_white" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td width="70%" style="text-align:right; color: #000; padding: 1em 2.5em;">Total</td>
  					  	<td width="30%" style="text-align:center; color: #000; padding:;">Rp {{number_format($order->biaya_total_produk,0,',','.')}}</td>
  					  </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td valign="middle" class="bg_white">
            <table class="bg_white" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td width="70%" style="text-align:right; color: #000; padding: 1em 2.5em;">Biaya Pengiriman</td>
  					  	<td width="30%" style="text-align:center; color: #000; padding:;">Rp {{number_format($order->biaya_pengiriman,0,',','.')}}</td>
  					  </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td valign="middle" class="bg_white">
            <table class="bg_white" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <th width="70%" style="text-align:right; color: #000; padding: 1em 2.5em;">Grand Total</th>
  					  	<th width="30%" style="text-align:center; color: #000; padding:;">Rp {{number_format($order->biaya_total_produk+$order->biaya_pengiriman,0,',','.')}}</th>
  					  </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td valign="middle" class="bg_white" style="padding: 1em 0 1em 0;">
            <table class="bg_white" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td width="100%" style="text-align:center; color: #000; padding-top:3em; padding-bottom:5em"> Terima Kasih Atas Kunjungan Anda</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

    </div>
  </center>
</body>
</html>
