<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#006600" d="M18,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h16V42z"></path> <path fill="#FE0000" d="M48,40c0,1.105-0.895,2-2,2H18V6h28c1.105,0,2,0.895,2,2V40z"></path> <circle fill="#FAFB00" cx="18" cy="22" r="6"></circle></g></svg></template>

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