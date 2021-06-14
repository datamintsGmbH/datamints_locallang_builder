<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#EC3122" d="M48,24H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V24z"></path> <path fill="#119A4A" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V22h48V40z"></path> <path fill="#EBCA19" d="M32.361,21.041h-5.891L24,15.683l-2.473,5.358h-5.889l4.303,4.453l-1.59,6.453L24,28.739l5.648,3.208 l-1.59-6.453L32.361,21.041z"></path></g></svg></template>

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