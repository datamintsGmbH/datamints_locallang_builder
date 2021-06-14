<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#DD2026" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <rect y="18" fill="#0038A7" width="48" height="12"></rect> <path fill="#E6E6E6" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <path fill="#EE1E2E" d="M18,14H6v10.93c0,0.669,0.334,1.293,0.891,1.664L12,30l5.109-3.406C17.666,26.223,18,25.598,18,24.93V14z"></path> <rect x="8" y="16" fill="#FFFFFF" width="8" height="2"></rect> <rect x="10" y="20" fill="#FFFFFF" width="4" height="2"></rect> <rect x="10" y="24" fill="#FFFFFF" width="4" height="2"></rect></g></svg></template>

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