<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#FDCB08" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <rect y="18" fill="#00287A" width="48" height="12"></rect> <path fill="#D0142C" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <path fill="#FFFFFF" d="M26.129,23.295h-1.5L24,21.93l-0.629,1.365h-1.5l1.096,1.132l-0.404,1.644L24,25.254l1.438,0.816 l-0.404-1.644L26.129,23.295z"></path> <path fill="#FFFFFF" d="M18.258,25.365h-1.5L16.129,24L15.5,25.365H14l1.096,1.132l-0.404,1.644l1.438-0.816l1.437,0.816 l-0.404-1.644L18.258,25.365z"></path> <path fill="#FFFFFF" d="M34.258,25.365h-1.5L32.129,24L31.5,25.365H30l1.096,1.132l-0.404,1.644l1.438-0.816l1.437,0.816 l-0.404-1.644L34.258,25.365z"></path></g></svg></template>

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