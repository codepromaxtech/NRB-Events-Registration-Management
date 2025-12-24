<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            margin: 0;
            padding: 0;
            size: 288pt 360pt; /* Match PNG dimensions (approx 4x5 inches) */
        }
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            width: 288pt;
            height: 360pt;
        }
        .container {
            width: 100%;
            height: 100%;
            position: relative;
            background: white;
            overflow: hidden;
        }
        
        /* Asset Layers */
        .layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        /* Layer Order based on user instruction */
        .layer-1 { z-index: 1; } /* 1st-bg */
        .layer-2 { z-index: 2; } /* 2nd-bg */
        .layer-3 { z-index: 3; } /* date-venue-red-line */
        .layer-4 { z-index: 4; } /* Delegate */
        .layer-5 { z-index: 5; } /* Flag */
        .layer-6 { z-index: 6; } /* image (Photo placeholder) */
        /* Layer 7 (Name-designation) REMOVED */
        .layer-8 { z-index: 8; } /* NRb-logo */
        
        /* Dynamic Content */
        .dynamic-content {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 20; /* Above all graphics */
        }
        
        /* Photo: Positioned over 'image.png' */
        /* Analysis: x=177, y=53, w=72, h=90 */
        /* Photo: Positioned over 'image.png' */
        /* Analysis: x=177, y=53, w=72, h=90 */
        .photo-wrapper {
            position: absolute;
            top: 53pt;
            left: 177pt;
            width: 72pt;
            height: 90pt;
            z-index: 25;
            text-align: center;
        }
        .photo {
            width: 70pt;
            height: 70pt;
            border-radius: 6pt;
            object-fit: cover;
            border: 1pt solid #fff;
            margin-top: 10pt;
        }
        
        /* Info Section: Matches 'Name-designation.png' main block */
        /* Analysis: y=165 to 243 (Height 78), x=50 to 239 (Width 189) */
        .info-wrapper {
            position: absolute;
            top: 165pt;
            left: 50pt;
            width: 189pt;
            height: 78pt;
            text-align: left; /* Left alignment */
            z-index: 25;
            display: block;
        }
        .info-row {
            color: #ffffff;
            font-size: 9pt; /* Standard size for all except name */
            margin-bottom: 2pt;
            line-height: 1.2;
        }
        .name-row {
            color: #ffffff;
            font-size: 12pt; /* Name is a little bit bigger */
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 4pt;
        }
        .label {
            font-weight: bold;
            margin-right: 2pt;
        }
        .value {
            font-weight: normal;
        }
        .country {
            /* Inherits standard size from info-row */
            text-transform: uppercase;
        }
        
        /* Date/Venue Section: Moved above Name section */
        /* Analysis matched segment at Y=153-161 */
        .date-venue-wrapper {
            position: absolute;
            top: 150pt;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 25;
        }
        /* Red line removed as it belongs to Delegate section */
        .dv-text {
            font-size: 9pt;
            font-weight: bold;
            color: #ffffff; /* White text */
            text-transform: uppercase;
        }

        /* Info Section: Matches 'Name-designation.png' main block */
        /* Analysis: y=165 to 243 */
        .info-wrapper {
            position: absolute;
            top: 170pt; /* Moved down slightly to clear the date/venue */
            left: 50pt;
            width: 189pt;
            height: 78pt;
            text-align: left;
            z-index: 25;
            display: block;
        }
        .info-row {
            color: #ffffff;
            font-size: 9pt;
            margin-bottom: 2pt;
            line-height: 1.2;
        }
        .name-row {
            color: #ffffff;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 4pt;
        }
        .label {
            font-weight: bold;
            margin-right: 2pt;
        }
        .value {
            font-weight: normal;
        }
        .country {
            text-transform: uppercase;
        }
        
        /* Delegate Footer Bar */
        .delegate-footer {
            position: absolute;
            bottom: 0; /* Stick to very bottom */
            left: 0;
            width: 100%;
            height: 25pt;
            background-color: #EC1C24; /* Brand Red */
            text-align: center;
            z-index: 25;
            line-height: 25pt; /* Vertically center text */
        }
        .delegate-text {
            font-size: 14pt;
            font-weight: bold;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2pt;
        }
        
        /* Meta Info Removed (ID moved to info-wrapper) */
    </style>
</head>
<body>
    <div class="container">
        <!-- Layers -->
        <img src="{{ public_path('images/card-assets/1st-bg.png') }}" class="layer layer-1">
        <img src="{{ public_path('images/card-assets/2nd-bg.png') }}" class="layer layer-2">
        <!-- Layer 3 Removed -->
        <!-- Layer 4 (Delegate) Removed -->
        <img src="{{ public_path('images/card-assets/Flag.png') }}" class="layer layer-5">
        <!-- Layer 6 Removed -->
        <!-- Layer 7 Removed -->
        <img src="{{ public_path('images/card-assets/NRb-logo.png') }}" class="layer layer-8">
        
        <!-- Dynamic Content -->
        <div class="dynamic-content">
            <div class="photo-wrapper">
                @if($registration->photo_path)
                    <img src="{{ public_path('storage/' . $registration->photo_path) }}" class="photo">
                @endif
            </div>
            
            <!-- Date/Venue Section (Before Name) -->
            <div class="date-venue-wrapper">
                <div class="dv-text">30 December || Sheraton Dhaka</div>
            </div>
            
            <div class="info-wrapper">
                <div class="name-row">
                    <span class="label">Name:</span> <span class="value">{{ $registration->name }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Designation:</span> <span class="value">{{ $registration->designation ?? 'Participant' }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Organization:</span> <span class="value">{{ $registration->organization }}</span>
                </div>
                <div class="info-row country">
                    <span class="label">Country:</span> <span class="value">{{ $registration->country }}</span>
                </div>
                <div class="info-row">
                    <span class="label">ID:</span> <span class="value">{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            
            <!-- Delegate Footer -->
            <div class="delegate-footer">
                <span class="delegate-text">Delegate</span>
            </div>
        </div>
    </div>
</body>
</html>
