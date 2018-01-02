<template>
    <div class="content">
        <div class="content-title">
            <h3>友链管理</h3>
        </div>
        <div class="operate" slot="buttons">
            <router-link to="/admin/links/create" class="btn btn-primary">创建友链<i class="el-icon-edit-outline el-icon-right"></i></router-link>
        </div>

        <el-table
                :data="linkList"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="友链名称">
            </el-table-column>
            <el-table-column
                    prop="site"
                    label="友链地址">
            </el-table-column>
            <el-table-column
                    prop="link_image"
                    label="图片">
            </el-table-column>
            <el-table-column
                    prop="rank"
                    label="排序">
            </el-table-column>
            <el-table-column
                    prop="updated_at"
                    label="更新时间">
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            type="primary"
                            @click="editLink(scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deleteLink(scope.row)">删除</el-button>
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
                linkList: [],
                currentPage: 1,
                totalPage: 0,
                total: 0,
                pageSize: 10
            }
        },
        created() {
            this.loadLink();
        },
        methods: {
            loadLink: function (page) {
                var self = this;
                var url = page ? '/link?page=' + page : '/link';
                this.$http.get(url)
                        .then(function (response) {
                            if (response.data.success) {
                                self.linkList = response.data.data.data;
                                self.totalPage = response.data.data.last_page;
                                self.total = response.data.data.total;
                                self.pageSize = response.data.data.per_page;
                            }
                        })
            },
            editLink: function (row) {
                this.$router.push({
                    path: 'links/' + row.id + '/edit'
                });
            },
            deleteLink: function (row) {
                var self = this;
                self.$confirm('此操作将从数据库中永久删除, 请确认是否继续?', '疯狂提醒中...', {
                            confirmButtonText: '继续',
                            cancelButtonText: '取消',
                            type: 'warning'
                        }
                ).then(function () {
                            this.$http.delete('/link/' + row.id)
                                    .then(function (response) {
                                        self.$message({
                                            message: response.data.message,
                                            type: response.data.success ? 'success' : 'error',
                                            showClose: true
                                        });
                                        if (response.data.success) {
                                            self.loadLink(self.currentPage);
                                        }
                                    })
                        }
                ).catch(function () {
                });
            },
            // 翻页
            handleCurrentChange(val) {
                this.currentPage = val;
                this.loadLink(val);
            }
        }
    }
</script>