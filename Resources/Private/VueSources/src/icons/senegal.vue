<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect x="16" y="6" fill="#EBCA19" width="16" height="36"></rect> <path fill="#DD2027" d="M48,40c0,1.105-0.895,2-2,2H32V6h14c1.105,0,2,0.895,2,2V40z"></path> <path fill="#0D8643" d="M16,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h14V42z"></path> <path fill="#0D8643" d="M30.305,21.723h-4.441L24,17.684l-1.863,4.039h-4.441l3.244,3.359l-1.199,4.865l4.26-2.42l4.26,2.42 l-1.199-4.865L30.305,21.723z"></path></g></svg></template>

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