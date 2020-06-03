@extends('layouts.base')

@section('head')

@parent

<style>

@font-face {
    font-family: 'Futura PT Demi';
    src: url('/fonts/subset-FuturaPT-Demi.woff2') format('woff2'),
        url('/fonts/subset-FuturaPT-Demi.woff') format('woff'),
        url('/fonts/subset-FuturaPT-Demi.ttf') format('truetype');
    font-weight: 600;
    font-style: normal;
}

@font-face {
    font-family: 'Futura PT Book';
    src: url('/fonts/subset-FuturaPT-Book.woff2') format('woff2'),
        url('/fonts/subset-FuturaPT-Book.woff') format('woff'),
        url('/fonts/subset-FuturaPT-Book.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'Futura PT';
    src: url('/fonts/subset-FuturaPT-Medium.woff2') format('woff2'),
        url('/fonts/subset-FuturaPT-Medium.woff') format('woff'),
        url('/fonts/subset-FuturaPT-Medium.ttf') format('truetype');
    font-weight: 500;
    font-style: normal;
}

@font-face {
    font-family: 'Futura PT';
    src: url('/fonts/subset-FuturaPT-Heavy.woff2') format('woff2'),
        url('/fonts/subset-FuturaPT-Heavy.woff') format('woff'),
        url('/fonts/subset-FuturaPT-Heavy.ttf') format('truetype');
    font-weight: 900;
    font-style: normal;
}

@font-face {
    font-family: 'Futura PT';
    src: url('/fonts/subset-FuturaPT-Light.woff2') format('woff2'),
        url('/fonts/subset-FuturaPT-Light.woff') format('woff'),
        url('/fonts/subset-FuturaPT-Light.ttf') format('truetype');
    font-weight: 300;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT.woff2') format('woff2'),
        url('/fonts/FuturaLT.woff') format('woff'),
        url('/fonts/FuturaLT.ttf') format('truetype');
    font-weight: 500;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-CondensedLight.woff2') format('woff2'),
        url('/fonts/FuturaLT-CondensedLight.woff') format('woff'),
        url('/fonts/FuturaLT-CondensedLight.ttf') format('truetype');
    font-weight: 300;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-CondExtraBoldObl.woff2') format('woff2'),
        url('/fonts/FuturaLT-CondExtraBoldObl.woff') format('woff'),
        url('/fonts/FuturaLT-CondExtraBoldObl.ttf') format('truetype');
    font-weight: 800;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-CondensedOblique.woff2') format('woff2'),
        url('/fonts/FuturaLT-CondensedOblique.woff') format('woff'),
        url('/fonts/FuturaLT-CondensedOblique.ttf') format('truetype');
    font-weight: 500;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-CondensedBoldOblique.woff2') format('woff2'),
        url('/fonts/FuturaLT-CondensedBoldOblique.woff') format('woff'),
        url('/fonts/FuturaLT-CondensedBoldOblique.ttf') format('truetype');
    font-weight: bold;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-Oblique.woff2') format('woff2'),
        url('/fonts/FuturaLT-Oblique.woff') format('woff'),
        url('/fonts/FuturaLT-Oblique.ttf') format('truetype');
    font-weight: 500;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-BookOblique.woff2') format('woff2'),
        url('/fonts/FuturaLT-BookOblique.woff') format('woff'),
        url('/fonts/FuturaLT-BookOblique.ttf') format('truetype');
    font-weight: normal;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-ExtraBoldOblique.woff2') format('woff2'),
        url('/fonts/FuturaLT-ExtraBoldOblique.woff') format('woff'),
        url('/fonts/FuturaLT-ExtraBoldOblique.ttf') format('truetype');
    font-weight: 800;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-LightOblique.woff2') format('woff2'),
        url('/fonts/FuturaLT-LightOblique.woff') format('woff'),
        url('/fonts/FuturaLT-LightOblique.ttf') format('truetype');
    font-weight: 300;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-HeavyOblique.woff2') format('woff2'),
        url('/fonts/FuturaLT-HeavyOblique.woff') format('woff'),
        url('/fonts/FuturaLT-HeavyOblique.ttf') format('truetype');
    font-weight: 900;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-Condensed.woff2') format('woff2'),
        url('/fonts/FuturaLT-Condensed.woff') format('woff'),
        url('/fonts/FuturaLT-Condensed.ttf') format('truetype');
    font-weight: 500;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-CondensedExtraBold.woff2') format('woff2'),
        url('/fonts/FuturaLT-CondensedExtraBold.woff') format('woff'),
        url('/fonts/FuturaLT-CondensedExtraBold.ttf') format('truetype');
    font-weight: 800;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-ExtraBold.woff2') format('woff2'),
        url('/fonts/FuturaLT-ExtraBold.woff') format('woff'),
        url('/fonts/FuturaLT-ExtraBold.ttf') format('truetype');
    font-weight: 800;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-Book.woff2') format('woff2'),
        url('/fonts/FuturaLT-Book.woff') format('woff'),
        url('/fonts/FuturaLT-Book.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-Bold.woff2') format('woff2'),
        url('/fonts/FuturaLT-Bold.woff') format('woff'),
        url('/fonts/FuturaLT-Bold.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-CondensedLightObl.woff2') format('woff2'),
        url('/fonts/FuturaLT-CondensedLightObl.woff') format('woff'),
        url('/fonts/FuturaLT-CondensedLightObl.ttf') format('truetype');
    font-weight: 300;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-CondensedBold.woff2') format('woff2'),
        url('/fonts/FuturaLT-CondensedBold.woff') format('woff'),
        url('/fonts/FuturaLT-CondensedBold.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-Light.woff2') format('woff2'),
        url('/fonts/FuturaLT-Light.woff') format('woff'),
        url('/fonts/FuturaLT-Light.ttf') format('truetype');
    font-weight: 300;
    font-style: normal;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-BoldOblique.woff2') format('woff2'),
        url('/fonts/FuturaLT-BoldOblique.woff') format('woff'),
        url('/fonts/FuturaLT-BoldOblique.ttf') format('truetype');
    font-weight: bold;
    font-style: italic;
}

@font-face {
    font-family: 'Futura LT';
    src: url('/fonts/FuturaLT-Heavy.woff2') format('woff2'),
        url('/fonts/FuturaLT-Heavy.woff') format('woff'),
        url('/fonts/FuturaLT-Heavy.ttf') format('truetype');
    font-weight: 900;
    font-style: normal;
}


html, body {
	height: 100%;

}

#sign {
	font-family: 'Futura PT';
	color: #FFF;

	height: 1080px;
	background-image: url('images/bg_diamondplate.jpg');
	background-repeat: no-repeat;
	background-size: 1920px 1080px;

	margin: 0 auto;

}

.clock {
	color: #93C841;
}

.time {
	font-family: 'Futura PT Demi', 'SansSerif';
	font-size: 3.5rem;
	font-weight: bolder;
	line-height: 0.7;
}

.date {
	font-size: 3rem;
	font-weight: lighter;
	line-height: 0.7;
}

.event-table {
	font-size: 2.5rem;
}

.event-table .caption {
	background: #005897;
	opacity: 80%;

}

.event-table .caption p {
	font-family: 'Futura PT Book';
	font-size: 4rem;
	color: #FFF;
}

.event-table .caption span {
	color: #93C841;
}

.event-table .header,
.event-table .body {
	background: #FFF;
	opacity: 58%;
	color: #000;
	line-height: 0.7;

}

.event-table .header {
	font-family: 'Futura PT';
	font-weight: bolder;
	line-height: 0.9;
}

.event-table .header .row {
	border-bottom: 2px solid;
}

.event-table .body {
	font-family: 'Futura PT Demi';
}

.event-table .body .col-2 {
	border-right: 1px solid;
}

</style>

@endsection

@section('body')
<main>
	@yield('content')
</main>
@endsection