<template>
    <div class="content">
        <div class="content-title">
            <h3>文章管理</h3>
        </div>
        <div class="operate" slot="buttons">
            <router-link to="/admin/articles/create" class="btn btn-primary"><i class="el-icon-edit"></i> 创建</router-link>
        </div>

        <el-table
                :data="articleList"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="文章标题">
            </el-table-column>
            <el-table-column
                    prop="category.name"
                    label="分类名称">
            </el-table-column>
            <el-table-column
                    prop="view_count"
                    label="浏览次数">
            </el-table-column>
            <el-table-column
                    width="100"
                    label="是否原创">
                <template slot-scope="scope">
                    <el-switch
                            v-model="scope.row.is_original"
                            active-value="1"
                            inactive-value="0"
                            active-color="#13ce66"
                            disabled>
                    </el-switch>
                </template>
            </el-table-column>
            <el-table-column
                    prop="status"
                    label="发表状态">
                <template scope="scope">
                    <span v-if="scope.row.status == 10">草稿</span>
                    <span v-else-if="scope.row.status == 20">已发布</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="published_at"
                    label="发表时间">
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            type="primary"
                            @click="editArticle(scope.row)"><i class="el-icon-edit-outline"></i> 编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deleteArticle(scope.row)"><i class="el-icon-delete"></i> 删除</el-button>
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
                articleList: [],
                currentPage: 1,
                totalPage: 0,
                total: 0,
                pageSize: 10,
                pageTitle: '文章管理'
            }
        },
        created () {
            this.loadArticle();
        },
        methods: {
            /**
             * 加载文章列表
             * @param page
             */
            loadArticle: function (page) {
                var self = this;
                var url = page ? '/article?page=' + page : '/article';
                this.$http.get(url)
                        .then(function (response) {
                            if (response.data.success) {
                                self.articleList = response.data.data.data;
                                self.totalPage = response.data.data.last_page;
                                self.total = response.data.data.total;
                                self.pageSize = response.data.data.per_page;
                            }
                        })
            },
            /**
             * 编辑文章
             * @param row
             */
            editArticle: function (row) {
                this.$router.push({
                    path: 'articles/' + row.id + '/edit'
                });
            },
            /**
             * 删除文章
             * @param row
             */
            deleteArticle: function (row) {
                var self = this;
                self.$confirm('此操作将从数据库中永久删除, 请确认是否继续?', '疯狂提醒中...', {
                            confirmButtonText: '继续',
                            cancelButtonText: '取消',
                            type: 'warning'
                        }
                ).then(() => {
                    this.$http.delete('/article/' + row.id)
                            .then(function (response) {
                                self.$message({
                                    message: response.data.message,
                                    type: response.data.success ? 'success' : 'error',
                                    showClose: true
                                });
                                if (response.data.success) {
                                    self.loadArticle(self.currentPage);
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
            handleCurrentChange (val) {
                this.currentPage = val;
                this.loadArticle(this.currentPage);
            }
        }
    }
</script>