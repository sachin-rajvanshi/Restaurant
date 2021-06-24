<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $data['subject'] }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">	
        <tr>
            <td style="padding: 10px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                    <tr>
                        <td style="color: #153643; padding:10px 0;font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                            <img src="{{ $data['logo'] }}" alt="lOGO" width="200px" height="auto" style="display: block;" />
                        </td>
                    </tr>
                    @if(Storage::exists($data['image']))
                    <tr>
                        <td align="center" style="padding: 10px 0 10px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                            <img src="{{ $data['image'] }}" alt="Welcome" width="100%" height="auto" style="display: block;"/>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 10px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px;">
                                        {!! $data['template'] !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #153643; padding:10px 0;font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                        <img src="{{ $data['logo'] }}" alt="lOGO" width="200px" height="auto" style="display: block;" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>