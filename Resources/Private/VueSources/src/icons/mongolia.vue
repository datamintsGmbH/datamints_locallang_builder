<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#C22A34" d="M48,40c0,1.105-0.895,2-2,2H32V6h14c1.105,0,2,0.895,2,2V40z"></path> <path fill="#C22A34" d="M16,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h14V42z"></path> <rect x="16" y="6" fill="#0A5395" width="16" height="36"></rect> <path fill="#F8CE2F" d="M10,18v2H6v-2H4v12h2v-2h4v2h2V18H10z M10,26H6v-4h4V26z"></path> <path fill="#F8CE2F" d="M8,18c1.104,0,2-0.895,2-2s-2-4-2-4s-2,2.895-2,4S6.896,18,8,18z"></path></g></svg></template>

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