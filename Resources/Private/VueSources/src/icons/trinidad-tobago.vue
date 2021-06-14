<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,39.834c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-32c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2 V39.834z"></path> <path fill="#D90E2B" d="M46,6H12l36,24V8C48,6.896,47.105,6,46,6z"></path> <path fill="#D90E2B" d="M2,42h34L0,18v22C0,41.104,0.895,42,2,42z"></path> <path fill="#1C1C1C" d="M43.211,42H46c1.105,0,2-0.896,2-2v-5.193L4.789,6H2C0.895,6,0,6.896,0,8v5.193L43.211,42z"></path></g></svg></template>

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