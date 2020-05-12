import { Line, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
  extends: Line,
  mixins: [reactiveProp],
  options: {
    responsive: true,
    maintainAspectRatio: false
  },
  props: ['options'],
  mounted () {
    // this.chartData is created in the mixin.
    // If you want to pass options please create a local options object
    this.renderChart(this.chartData, this.options)
  },
  // watch: {
  //   chartData () {
  //     this.$data._chart.destroy()
  //     this.renderChart(this.chartData, this.options)
  //   }
  // }
}

// import { Line } from 'vue-chartjs'

// export default {
//   extends: Line,
//   props: ['chartdata', 'options'],
//   mounted () {
//     this.renderChart(this.chartdata, this.options)
//   }
// }

// import { Bar } from 'vue-chartjs'

// export default {
//   extends: Bar,
//   mounted () {
//     this.renderChart(data, options)
//   }
// }