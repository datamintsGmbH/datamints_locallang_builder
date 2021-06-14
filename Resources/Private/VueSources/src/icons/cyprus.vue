<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#ED8000" d="M34,16v2h-2v-2h-2v2h-2v-2h-2v2h-4v-2h-2v2h-2v-2h-2v2h-2v-2c-1.105,0-2,0.896-2,2v4c0,1.104,0.895,2,2,2v-2 h2v2h2v-2h2v2h2v-2h4v2h2v-2h2v2h2v-2h2v2c1.105,0,2-0.896,2-2v-4C36,16.896,35.105,16,34,16z"></path> <path fill="#11674A" d="M10,30h12v-2H12C10.895,28,10,28.895,10,30z"></path> <path fill="#11674A" d="M26,30h12c0-1.105-0.895-2-2-2H26V30z"></path></g></svg></template>

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