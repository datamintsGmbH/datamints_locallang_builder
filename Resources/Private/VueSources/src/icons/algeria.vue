<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0C7439" d="M24,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h22V42z"></path> <rect x="24" y="6" fill="#E6E6E6" width="24" height="36"></rect> <path fill="#BD283B" d="M31.199,22.665L29.971,20l-1.23,2.665h-2.8l2.047,2.117l-0.783,3.177l2.766-1.571l2.766,1.571l-0.783-3.177 L34,22.665H31.199z"></path> <path fill="#BD283B" d="M28,32c-4.418,0-8-3.582-8-8s3.582-8,8-8c0.864,0,1.682,0.172,2.461,0.426C28.715,14.935,26.477,14,24,14 c-5.522,0-10,4.478-10,10s4.478,10,10,10c2.477,0,4.715-0.935,6.462-2.426C29.682,31.827,28.864,32,28,32z"></path></g></svg></template>

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