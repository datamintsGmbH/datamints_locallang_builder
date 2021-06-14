<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#161796" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <polygon fill="#FFFF00" points="12,6 38,42 38,6 "></polygon> <polygon fill="#FFFFFF" points="11.717,10.997 12.813,9.865 11.313,9.865 10.684,8.5 10.055,9.865 8.555,9.865 9.65,10.997 9.246,12.641 10.684,11.824 12.121,12.641 "></polygon> <polygon fill="#FFFFFF" points="16.297,15.287 14.797,15.287 14.168,13.922 13.539,15.287 12.039,15.287 13.135,16.419 12.73,18.063 14.168,17.246 15.605,18.063 15.201,16.419 "></polygon> <polygon fill="#FFFFFF" points="18.834,21.794 19.93,20.662 18.43,20.662 17.801,19.297 17.172,20.662 15.672,20.662 16.768,21.794 16.363,23.438 17.801,22.621 19.238,23.438 "></polygon> <polygon fill="#FFFFFF" points="23.492,25.865 21.992,25.865 21.363,24.5 20.734,25.865 19.234,25.865 20.33,26.997 19.926,28.641 21.363,27.824 22.801,28.641 22.396,26.997 "></polygon> <polygon fill="#FFFFFF" points="27.313,31.287 25.813,31.287 25.184,29.922 24.555,31.287 23.055,31.287 24.15,32.419 23.746,34.063 25.184,33.246 26.621,34.063 26.217,32.419 "></polygon> <polygon fill="#FFFFFF" points="31.57,36.725 30.07,36.725 29.441,35.359 28.813,36.725 27.313,36.725 28.408,37.856 28.004,39.5 29.441,38.684 30.879,39.5 30.475,37.856 "></polygon></g></svg></template>

<script>
export default {
	props: {
		width: {
			type: [Number, String],
			default: "100%"
		},
		height: {
			type: [Number, String],
			default: "100%"
		},
		fill: {
			type: String,
			default: "currentColor"
		},
		secondaryfill: {
			type: String
		}
	},
	computed: {
		_secondaryfill: function () {
			return this.secondaryfill || this.fill
		}
	}
}
</script>