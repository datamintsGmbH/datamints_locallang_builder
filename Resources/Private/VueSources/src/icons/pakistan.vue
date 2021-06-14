<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#05401D" d="M48,40c0,1.105-0.895,2-2,2H16V6h30c1.105,0,2,0.895,2,2V40z"></path> <path fill="#FFFFFF" d="M42,22.684h-2.947L37.816,20l-1.238,2.684h-2.945l2.152,2.227l-0.797,3.23l2.828-1.605l2.828,1.605 l-0.797-3.23L42,22.684z"></path> <path fill="#FFFFFF" d="M34,30c-3.312,0-6-2.687-6-6c0-3.312,2.688-6,6-6c0.52,0,1.016,0.086,1.496,0.211 C34.063,16.85,32.135,16,30,16c-4.418,0-8,3.582-8,8s3.582,8,8,8c2.135,0,4.063-0.85,5.496-2.211C35.016,29.914,34.52,30,34,30z"></path> <path fill="#E6E6E6" d="M16,6H2C0.895,6,0,6.895,0,8v32c0,1.105,0.895,2,2,2h14V6z"></path></g></svg></template>

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