@include('emails.header')
<table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
    <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
            <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                <!-- START CENTERED WHITE CONTAINER -->
                <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
                <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Olá <B>{{ $client->name }}</B>,</p>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Estamos lhe encaminhando um demonstrativo de faturas em aberto no período {{ now()->format('m/Y') }}</p>


                                        <table border="0" cellpadding="5" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                           <thead>
                                           <tr>
                                                <td align="left" style="font-family: sans-serif; font-size: 12px; vertical-align: top; ">
                                                    DATA
                                                </td>
                                               <td align="left" style="font-family: sans-serif; font-size: 12px; vertical-align: top; ">
                                                   OBSERVAÇÃO
                                               </td>
                                               <td align="left" style="font-family: sans-serif; font-size: 12px; vertical-align: top; ">
                                                   VALOR
                                               </td>
                                           </tr>
                                           </thead>

                                            <tbody>
                                                @foreach ($invoices as $bill)
                                                    <tr>
                                                        <td align="left" style="font-family: sans-serif; font-size: 12px; vertical-align: top; ">
                                                            {{ $bill->due->format('d/m/Y') }}
                                                        </td>
                                                        <td align="left" style="font-family: sans-serif; font-size: 12px; vertical-align: top; ">
                                                            {{ $bill->description  }}
                                                        </td>
                                                        <td align="left" style="font-family: sans-serif; font-size: 12px; vertical-align: top; ">
                                                            {{ $bill->amount }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
<br><Br>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Caso você já tenha  regularizado estas pendências, pedimos que desconsidere este e-mail</p>

                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Se preferir entre em contato com nossa equipe de negociação.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>

@include('emails.footer')