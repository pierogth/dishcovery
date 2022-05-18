<template>
  <div class="article-preview">
    <article-meta
      :author-username="article.user.username"
      :created-at="article.createdAt"
      :author-image="article.user.image"
    >
    <button v-if="isLoggedInAndAdmin" @click="deleteArticle(article.slug)">Elimina</button>
      <article-favorites-button
        class="pull-xs-right"
        :favorited="article.favorited"
        :favorites-count="article.favorited_count"
        :slug="article.slug"
      />
    </article-meta>
    
    <router-link
      :to="{ name: $routesNames.articleView, params: { slug: article.slug } }"
      href=""
      class="preview-link"
    >
      <h1>{{ article.title }}</h1>
      <p>{{ article.description }}</p>
      <span>Read more...</span>
    </router-link>
    
    <div class="pull-xs-right">
      <span
        v-for="tag in visibleTags"
        :key="tag"
        class="tag-pill tag-default tag-outline"
      >
        {{ tag.name }}
      </span>
      <span v-if="nonVisibleTagsNumber > 0">
        ... and {{ nonVisibleTagsNumber }} more.
      </span>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";
import Article from "@/store/modules/Article";
import ArticleFavoritesButton from "@/components/ArticleFavoritesButton.vue";
import ArticleMeta from "@/components/ArticleMeta.vue";
import { IArticle, IProfile } from "@/services/realWorldApi/models";
import Profile from "@/store/modules/Profile";
import User from "@/store/modules/User";

const MAX_VISIBLE_TAGS = 5;

@Component({
  components: {
    ArticleMeta,
    ArticleFavoritesButton
  }
})
export default class ArticlePreview extends Vue {
  @Prop({ required: true }) readonly article!: IArticle;

  isLoading = false;

  get visibleTags(): string[] {
    return this.article.tags.slice(0, MAX_VISIBLE_TAGS);
  }

  get nonVisibleTagsNumber(): number {
    return this.article.tags.length - MAX_VISIBLE_TAGS;
  }
  get author(): IProfile {
    return (
      Profile.profilesCache[this.article.author.username] || this.article.author
    );
  }

  get isLoggedInAndAdmin(): boolean {
    return User.isAdmin;
  }

  async deleteArticle(slug: string): Promise<void> {
    this.isLoading = true;
    try {

     await Article.delete(slug);
      
    } finally {
      this.isLoading = false;
      //location.reload();
    }
  }
}
</script>
