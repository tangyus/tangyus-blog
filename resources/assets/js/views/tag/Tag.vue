<template>
    <div class="content">
        <div class="content-title">
            <h3>标签管理</h3>
        </div>
        <div class="operate" slot="buttons">
            <router-link to="/admin/tags/create" class="btn btn-primary">创建标签<i class="el-icon-edit-outline el-icon-right"></i></router-link>
        </div>

        <el-table
                :data="tagList"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="标签名称">
            </el-table-column>
            <el-table-column
                    prop="category.name"
                    label="所属分类">
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
                            @click="editTag(scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deleteTag(scope.row)">删除</el-button>
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
                tagList: [],
                currentPage: 1,
                totalPage: 0,
                total: 0,
                pageSize: 10
            }
        },
        created() {
            this.loadTag();
        },
        methods: {
            /**
             * 加载标签信息
             */
            loadTag: function (page) {
                var self = this;
                var url = page ? '/tag?page=' + page : '/tag';
                this.$http.get(url)
                        .then(function (response) {
                            if (response.data.success) {
                                self.tagList = response.data.data.data;
                                self.totalPage = response.data.data.last_page;
                                self.total = response.data.data.total;
                                self.pageSize = response.data.data.per_page;
                            }
                        })
            },
            /**
             * 编辑标签
             */
            editTag: function (row) {
                this.$router.push({
                    path: 'tags/' + row.id + '/edit'
                });
            },
            /**
             * 删除标签
             * @param row
             */
            deleteTag: function (row) {
                var self = this;
                self.$confirm('此操作将从数据库中永久删除, 请确认是否继续?', '疯狂提醒中...', {
                    confirmButtonText: '继续',
                    cancelButtonText: '取消',
                    type: 'warning'
                    }
                ).then(() => {
                    this.$http.delete('/tag/' + row.id)
                        .then(function (response) {
                            self.$message({
                                message: response.data.message,
                                type: response.data.success ? 'success' : 'error',
                                showClose: true
                            });
                            if (response.data.success) {
                                self.loadTag(self.currentPage);
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
                this.loadTag(val);
            }
        }
    }
</script>