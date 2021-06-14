<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#DA1E05" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#FFFFFF" d="M35,28H13c-0.552,0-1-0.448-1-1v-6c0-0.552,0.448-1,1-1h22c0.552,0,1,0.448,1,1v6C36,27.552,35.552,28,35,28 z"></path> <path fill="#FFFFFF" d="M27,36h-6c-0.552,0-1-0.448-1-1V13c0-0.552,0.448-1,1-1h6c0.552,0,1,0.448,1,1v22C28,35.552,27.552,36,27,36 z"></path></g></svg></template>

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