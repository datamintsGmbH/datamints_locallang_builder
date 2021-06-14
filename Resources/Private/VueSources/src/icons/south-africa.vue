<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <polygon fill="#DDB954" points="0,14 0,18 10,24 0,30 0,34 16,24 "></polygon> <polygon points="0,18 0,30 10,24 "></polygon> <path fill="#1A3A73" d="M48,40c0,1.105-0.895,2-2,2H10l14-10h24V40z"></path> <path fill="#BD1D27" d="M48,16H24L10,6h36c1.105,0,2,0.895,2,2V16z"></path> <path fill="#0E825D" d="M23.395,20l-21-14H2C0.896,6,0,6.895,0,8v6l16,10L0,34v6c0,1.105,0.896,2,2,2h0.395l21-14H48v-8H23.395z"></path></g></svg></template>

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