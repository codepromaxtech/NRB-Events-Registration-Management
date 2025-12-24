<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .badge {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .header {
            background-color: #00793A; /* Brand Green */
            color: #EC1C24; /* Brand Red */
            padding: 20px 15px;
            text-align: center;
            border-bottom: 4px solid #EC1C24;
        }
        .logo {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #ffffff;
        }
        .logo span {
            color: #EC1C24;
        }
        .sub-header {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 5px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .content {
            padding: 25px 20px;
            text-align: center;
        }
        .photo-container {
            margin-bottom: 15px;
        }
        .photo {
            width: 100px;
            height: 100px;
            border: 3px solid #00793A;
            border-radius: 50%;
            object-fit: cover;
            padding: 2px;
            background: #fff;
        }
        .name {
            font-size: 22px;
            font-weight: bold;
            color: #00793A;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .designation {
            font-size: 12px;
            color: #EC1C24;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .organization {
            font-size: 14px;
            color: #334155;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .details-table {
            width: 100%;
            margin-top: 10px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
        .detail-row {
            font-size: 10px;
            color: #475569;
            margin-bottom: 3px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #00793A;
            padding: 10px;
            text-align: center;
            font-size: 9px;
            color: #ffffff;
        }
        .badge-type {
            position: absolute;
            top: 20px;
            right: -30px;
            background-color: #EC1C24;
            color: #ffffff;
            padding: 5px 40px;
            transform: rotate(45deg);
            font-size: 10px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 10;
        }
        .qr-code {
            position: absolute;
            bottom: 40px;
            right: 20px;
            width: 50px;
            height: 50px;
            border: 1px solid #ddd;
            padding: 2px;
        }
    </style>
</head>
<body>
    <div class="badge">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" style="height: 40px; display: block; margin: 0 auto;">
            <div class="sub-header">Connecting Global Leaders</div>
        </div>
        
        <div class="badge-type">DELEGATE</div>

        <div class="content">
            <div class="photo-container">
                @if($registration->photo_path)
                    <img src="{{ public_path('storage/' . $registration->photo_path) }}" class="photo">
                @else
                    <div class="photo" style="background-color: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; font-size: 10px; color: #94a3b8; line-height: 100px;">No Photo</div>
                @endif
            </div>
            
            <div class="name">{{ $registration->name }}</div>
            <div class="designation">{{ $registration->designation ?? 'Participant' }}</div>
            <div class="organization">{{ $registration->organization }}</div>

            <div class="details-table">
                @if($registration->website)
                    <div class="detail-row"><strong>Web:</strong> {{ $registration->website }}</div>
                @endif
                <div class="detail-row"><strong>Email:</strong> {{ $registration->email }}</div>
                <div class="detail-row"><strong>Loc:</strong> {{ $registration->city }}, {{ $registration->country }}</div>
            </div>
        </div>

        <div class="footer">
            NRB Global Convention 2025 &bull; New York, USA
        </div>
    </div>
</body>
</html>
