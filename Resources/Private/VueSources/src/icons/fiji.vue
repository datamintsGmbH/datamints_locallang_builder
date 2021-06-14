<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path d="M46,6H2A2,2,0,0,0,0,8V40a2,2,0,0,0,2,2H46a2,2,0,0,0,2-2V8A2,2,0,0,0,46,6Z" fill="#7dbde1"></path> <path d="M2,6H24a0,0,0,0,1,0,0V24a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V8A2,2,0,0,1,2,6Z" fill="#00017a"></path> <polygon points="19 19 16 19 16 19.25 22.333 24 24 24 24 22.75 19 19" fill="red"></polygon> <path d="M.12,7.34,5,11H8v-.25L1.706,6.03A1.991,1.991,0,0,0,.12,7.34Z" fill="red"></path> <polygon points="24 6 22.334 6 16 10.75 16 11 19.001 11 24 7.25 24 6" fill="red"></polygon> <polygon points="0 22.75 0 24 1.667 24 8 19.25 8 19 5 19 0 22.75" fill="red"></polygon> <polygon points="24 13 14 13 14 6 10 6 10 13 0 13 0 17 10 17 10 24 14 24 14 17 24 17 24 13" fill="red"></polygon> <path d="M42,31c0,2-6,5-6,5s-6-3-6-5V22H42Z" fill="#fff"></path> <rect x="30" y="27" width="12" height="2" fill="red"></rect> <path d="M36,36s.405-.2,1-.535V22H35V35.465C35.6,35.8,36,36,36,36Z" fill="red"></path></g></svg></template>

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