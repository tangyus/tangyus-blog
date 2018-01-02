<template>
    <div class="content">
        <div class="content-title">
            <h3>分类管理</h3>
        </div>
        <div class="operate" slot="buttons">
            <router-link to="/admin/categories/create" class="btn btn-primary">创建分类<i class="el-icon-edit-outline el-icon-right"></i></router-link>
        </div>

        <el-table
                :data="categoryList"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="分类名称">
            </el-table-column>
            <el-table-column
                    prop="desc"
                    label="分类描述">
            </el-table-column>
            <el-table-column
                    prop="article_count"
                    label="文章数量">
            </el-table-column>
            <el-table-column
                    prop="updated_at"
                    label="修改时间">
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            type="primary"
                            @click="editCategory(scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deleteCategory(scope.row)">删除</el-button>
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
                categoryList: [],
                currentPage: 1,
                totalPage: 0,
                total: 0,
                pageSize: 10
            }
        },
        created() {
            this.loadCategory();
        },
        methods: {
            loadCategory: function (page) {
                var self = this;
                var url = page ? '/category?page=' + page : '/category';
                this.$http.get(url)
                        .then(function (response) {
                            if (response.data.success) {
                                self.categoryList = response.data.data.data;
                                self.totalPage = response.data.data.last_page;
                                self.total = response.data.data.total;
                                self.pageSize = response.data.data.per_page;
                            }
                        })
            },
            editCategory: function (row) {
                this.$router.push({
                    path: 'categories/' + row.id + '/edit'
                });
            },
            deleteCategory: function (row) {
                var self = this;
                self.$confirm('此操作将从数据库中永久删除, 请确认是否继续?', '疯狂提醒中...', {
                        confirmButtonText: '继续',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(function () {
                        this.$http.delete('/category/' + row.id)
                                .then(function (response) {
                                    self.$message({
                                        message: response.data.message,
                                        type: response.data.success ? 'success' : 'error',
                                        showClose: true
                                    });
                                    if (response.data.success) {
                                        self.loadCategory(self.currentPage);
                                    }
                                })
                        }
                    ).catch(function () {
                    });
            },
            // 翻页
            handleCurrentChange(val) {
                this.currentPage = val;
                this.loadCategory(val);
            }
        }
    }
</script>