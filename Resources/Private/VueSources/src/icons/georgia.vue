<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <polygon fill="#E7112D" points="48,22 26,22 26,6 22,6 22,22 0,22 0,26 22,26 22,42 26,42 26,26 48,26 "></polygon> <polygon fill="#E7112D" points="12,10.001 10,10.001 10,14.001 6,14.001 6,16.001 10,16.001 10,20.001 12,20.001 12,16.001 16,16.001 16,14.001 12,14.001 "></polygon> <polygon fill="#E7112D" points="38,14 38,10 36,10 36,14 32,14 32,16 36,16 36,20 38,20 38,16 42,16 42,14 "></polygon> <polygon fill="#E7112D" points="12,28.001 10,28.001 10,32.001 6,32.001 6,34.001 10,34.001 10,38.001 12,38.001 12,34.001 16,34.001 16,32.001 12,32.001 "></polygon> <polygon fill="#E7112D" points="38,28 36,28 36,32 32,32 32,34 36,34 36,38 38,38 38,34 42,34 42,32 38,32 "></polygon></g></svg></template>

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