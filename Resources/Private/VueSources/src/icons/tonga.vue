<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M20,26H0V8c0-1.105,0.895-2,2-2h18V26z"></path> <path fill="#FC0204" d="M46,6H20v20H0v14c0,1.105,0.896,2,2,2h44c1.104,0,2-0.895,2-2V24V8C48,6.895,47.104,6,46,6z"></path> <polygon fill="#FC0204" points="16,14 12,14 12,10 8,10 8,14 4,14 4,18 8,18 8,22 12,22 12,18 16,18 "></polygon></g></svg></template>

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