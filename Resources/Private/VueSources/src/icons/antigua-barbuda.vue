<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D90E2B" d="M48,40c0,1.105-0.895,2-2,2H24L42,6h4c1.105,0,2,0.895,2,2V40z"></path> <path fill="#D90E2B" d="M24,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h4L24,42z"></path> <polygon fill="#FFFFFF" points="24,42 24,42 15,24 33,24 "></polygon> <polygon fill="#0472C9" points="33,24 15,24 12,18 36,18 "></polygon> <path fill="#000302" d="M6,6l6,12h4c0-4.418,3.582-8,8-8s8,3.582,8,8h4l6-12H6z"></path> <path fill="#F8C422" d="M32,18c0-4.418-3.582-8-8-8s-8,3.582-8,8H32z"></path></g></svg></template>

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