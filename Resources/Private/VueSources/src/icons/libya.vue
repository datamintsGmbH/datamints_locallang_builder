<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E52635" d="M48,14H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V14z"></path> <rect y="14" fill="#41423D" width="48" height="20"></rect> <path fill="#0EA651" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-6h48V40z"></path> <path fill="#FFFFFF" d="M26,30c-3.313,0-6-2.687-6-6c0-3.312,2.687-6,6-6c0.52,0,1.016,0.086,1.497,0.211 C26.063,16.85,24.135,16,22,16c-4.418,0-8,3.582-8,8s3.582,8,8,8c2.135,0,4.063-0.85,5.497-2.211C27.016,29.914,26.52,30,26,30z"></path> <path fill="#FFFFFF" d="M34,22.543h-2.948l-1.236-2.684l-1.237,2.684h-2.947l2.153,2.227L26.988,28l2.827-1.605L32.643,28 l-0.796-3.23L34,22.543z"></path></g></svg></template>

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