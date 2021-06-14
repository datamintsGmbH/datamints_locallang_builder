<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#CE2029" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path d="M21.49,35.383C21.646,35.756,22.01,36,22.414,36h3.172c0.404,0,0.768-0.244,0.924-0.617c0.154-0.374,0.069-0.804-0.217-1.09 L24,32l-2.293,2.293C21.421,34.579,21.336,35.009,21.49,35.383z"></path> <path d="M26,18v-2c0-1.104,0.896-2,2-2c1.104,0,2-0.896,2-2h-4c-1.104,0-2,0.896-2,2c0-1.104-0.896-2-2-2h-4c0,1.104,0.896,2,2,2 c1.104,0,2,0.896,2,2v2H10c0,1.105,0.896,2,2,2h10v2H12c0,1.105,0.896,2,2,2h8v2h-8c0,1.104,0.896,2,2,2h6v2h-6c0,1.105,0.896,2,2,2 h4h2h2h4c1.104,0,2-0.895,2-2h-6v-2h6c1.104,0,2-0.896,2-2h-8v-2h8c1.104,0,2-0.895,2-2H26v-2h10c1.104,0,2-0.895,2-2H26z"></path></g></svg></template>

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