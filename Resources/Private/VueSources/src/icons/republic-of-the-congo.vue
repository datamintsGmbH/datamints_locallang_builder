<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#059746" d="M2,6h38L0,32V8C0,6.895,0.895,6,2,6z"></path> <path fill="#DD2525" d="M46,42H12l36-24v22C48,41.105,47.105,42,46,42z"></path> <path fill="#FBDE45" d="M12,42H2c-1.105,0-2-0.895-2-2v-8L40,6h6c1.105,0,2,0.895,2,2v10L12,42z"></path></g></svg></template>

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