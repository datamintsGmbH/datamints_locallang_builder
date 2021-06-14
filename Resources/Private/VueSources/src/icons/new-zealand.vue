<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path d="M46,6H2A2,2,0,0,0,0,8V40a2,2,0,0,0,2,2H46a2,2,0,0,0,2-2V8A2,2,0,0,0,46,6Z" fill="#0f2e72"></path> <polygon points="19 19 16 19 16 19.25 22.333 24 24 24 24 22.75 19 19" fill="red"></polygon> <path d="M.12,7.34,5,11H8v-.25L1.706,6.03A1.991,1.991,0,0,0,.12,7.34Z" fill="red"></path> <polygon points="24 6 22.334 6 16 10.75 16 11 19.001 11 24 7.25 24 6" fill="red"></polygon> <polygon points="0 22.75 0 24 1.667 24 8 19.25 8 19 5 19 0 22.75" fill="red"></polygon> <polygon points="24 13 14 13 14 6 10 6 10 13 0 13 0 17 10 17 10 24 14 24 14 17 24 17 24 13" fill="red"></polygon> <path d="M40,31.2H38.1l-.8-1.73-.8,1.73H34.615L36,32.628l-.511,2.082,1.82-1.032,1.82,1.032-.513-2.082Z" fill="red"></path> <path d="M33.946,21.377H32.557l-.583-1.268-.585,1.268H30l1.015,1.046-.374,1.525,1.333-.757,1.333.757-.376-1.525Z" fill="red"></path> <path d="M44.281,21.268H42.892L42.308,20l-.585,1.268H40.335l1.015,1.046-.375,1.525,1.333-.757,1.333.757-.376-1.525Z" fill="red"></path> <path d="M39.281,15.268H37.892L37.308,14l-.585,1.268H35.335l1.015,1.046-.375,1.525,1.333-.757,1.333.757-.376-1.525Z" fill="red"></path></g></svg></template>

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