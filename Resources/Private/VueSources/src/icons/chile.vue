<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D52A20" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V24h48V40z"></path> <path fill="#003AB5" d="M18,24H0V8c0-1.105,0.895-2,2-2h16V24z"></path> <path fill="#FFFFFF" d="M13.184,13.613h-2.947L9,10.93l-1.238,2.684H4.816l2.152,2.227l-0.797,3.23L9,17.465l2.828,1.605 l-0.797-3.23L13.184,13.613z"></path> <path fill="#E6E6E6" d="M48,24H18V6h28c1.105,0,2,0.895,2,2V24z"></path></g></svg></template>

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