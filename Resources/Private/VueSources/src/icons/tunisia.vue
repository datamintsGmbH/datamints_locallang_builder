<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E31E25" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <circle fill="#FFFFFF" cx="24" cy="24" r="12"></circle> <path fill="#E31E25" d="M27.199,30.4c-3.533,0-6.4-2.866-6.4-6.4s2.867-6.4,6.4-6.4c0.693,0,1.346,0.139,1.971,0.342 C27.771,16.748,25.98,16,24,16c-4.42,0-8,3.582-8,8s3.58,8,8,8c1.98,0,3.771-0.748,5.17-1.941 C28.545,30.262,27.893,30.4,27.199,30.4z"></path> <path fill="#E31E25" d="M29.258,22.706l-1.229-2.665l-1.23,2.665H24l2.047,2.117L25.264,28l2.766-1.571L30.795,28l-0.783-3.177 l2.047-2.117H29.258z"></path></g></svg></template>

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