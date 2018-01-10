<template>
    <div class="content">
        <div class="content-title">
            <h3>友链互换</h3>
        </div>
        <el-table
                :data="exchangeLinkList"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    prop="blog_name"
                    label="友链名称">
            </el-table-column>
            <el-table-column
                    prop="blog_site"
                    label="友链地址">
            </el-table-column>
            <el-table-column
                    prop="email"
                    label="博主邮箱">
            </el-table-column>
            <el-table-column
                    prop="status"
                    label="审核状态">
                <template scope="scope">
                    <span v-if="scope.row.is_checked == 10">审核拒绝</span>
                    <span v-else-if="scope.row.is_checked == 20">审核通过</span>
                    <span v-else>等待审核</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="提交时间">
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template slot-scope="scope" v-if="!scope.row.is_checked">
                    <el-button
                            size="mini"
                            type="primary"
                            @click="check(scope.row, 20)">通过</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="check(scope.row, 10)">拒绝</el-button>
                </template>
            </el-table-column>
        </el-table>

        <div class="block" v-if="totalPage >= 1">
            <el-pagination
                    @current-change="handleCurrentChange"
                    :current-page.sync="currentPage"
                    :page-size="pageSize"
                    layout="total, prev, pager, next"
                    :total="total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                exchangeLinkList: [],
                currentPage: 1,
                totalPage: 0,
                total: 0,
                pageSize: 10
            }
        },
        created() {
            this.loadExchangeLink();
        },
        methods: {
            /**
             * 加载友链信息
             * @param page
             */
            loadExchangeLink: function (page) {
                var self = this;
                var url = page ? '/link/exchange?page=' + page : '/link/exchange';
                this.$http.get(url)
                        .then(function (response) {
                            if (response.data.success) {
                                self.exchangeLinkList = response.data.data.data;
                                self.totalPage = response.data.data.last_page;
                                self.total = response.data.data.total;
                                self.pageSize = response.data.data.per_page;
                            }
                        })
            },
            /**
             * 删除友链
             * @param row
             */
            check: function (row, is_checked) {
                var self = this;
                var message = is_checked == 10 ? '拒绝通过?' : '通过审核?'
                self.$confirm(message, '疯狂提醒中...', {
                            confirmButtonText: '继续',
                            cancelButtonText: '取消',
                            type: 'warning'
                        }
                ).then(() => {
                            this.$http.post('/link/checkExchangeLink/' + row.id, {is_checked: is_checked})
                                    .then(function (response) {
                                        self.$message({
                                            message: response.data.message,
                                            type: response.data.success ? 'success' : 'error',
                                            showClose: true
                                        });
                                        if (response.data.success) {
                                            self.loadExchangeLink(self.currentPage);
                                        }
                                    })
                        }
                ).catch(() => {
                });
            },
            /**
             * 翻页
             * @param val
             */
            handleCurrentChange(val) {
                this.currentPage = val;
                this.loadExchangeLink(val);
            }
        }
    }
</script>